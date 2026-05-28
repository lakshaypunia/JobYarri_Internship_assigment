<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class UploadThingService
{
    private string $apiKey;
    private string $baseUrl = 'https://api.uploadthing.com/v6';

    public function __construct()
    {
        $this->apiKey = config('services.uploadthing.secret');
    }

    public function upload(UploadedFile $file): string
    {
        Log::info('[UploadThing] Starting upload', [
            'file_name'      => $file->getClientOriginalName(),
            'file_size'      => $file->getSize(),
            'file_mime'      => $file->getMimeType(),
            'file_real_path' => $file->getRealPath(),
            'api_key_prefix' => substr($this->apiKey, 0, 12) . '...',
        ]);

        // ── Step 1: get presigned URL ────────────────────────────────────────
        $payload = [
            'files' => [[
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'type' => $file->getMimeType(),
            ]],
            'acl'                => 'public-read',
            'contentDisposition' => 'inline',
        ];

        Log::info('[UploadThing] Calling uploadFiles endpoint', [
            'url'     => "{$this->baseUrl}/uploadFiles",
            'payload' => $payload,
        ]);

        $response = Http::withHeaders([
            'X-Uploadthing-Api-Key' => $this->apiKey,
        ])->asJson()->post("{$this->baseUrl}/uploadFiles", $payload);

        Log::info('[UploadThing] uploadFiles response', [
            'status' => $response->status(),
            'body'   => $response->body(),
        ]);

        if ($response->failed()) {
            throw new RuntimeException(
                "[UploadThing] Step 1 failed (HTTP {$response->status()}): {$response->body()}"
            );
        }

        $full      = $response->json();
        $uploadData = $full['data'][0] ?? null;

        Log::info('[UploadThing] Parsed uploadData', ['uploadData' => $uploadData]);

        if (!$uploadData) {
            throw new RuntimeException(
                '[UploadThing] Step 1: no data[0] in response. Full body: ' . $response->body()
            );
        }

        // ── Step 2: upload file to S3 ────────────────────────────────────────
        if (!empty($uploadData['presignedUrls'])) {
            // v6 format — PUT with raw body
            $putUrl = $uploadData['presignedUrls'][0];
            Log::info('[UploadThing] Using v6 PUT flow', ['put_url' => $putUrl]);

            $putResponse = Http::withHeaders(['Content-Type' => $file->getMimeType()])
                ->withBody(file_get_contents($file->getRealPath()), $file->getMimeType())
                ->put($putUrl);

            Log::info('[UploadThing] PUT response', [
                'status' => $putResponse->status(),
                'body'   => $putResponse->body(),
            ]);

            if ($putResponse->failed()) {
                throw new RuntimeException(
                    "[UploadThing] Step 2 PUT failed (HTTP {$putResponse->status()}): {$putResponse->body()}"
                );
            }

        } elseif (!empty($uploadData['url'])) {
            // Legacy format — multipart POST
            Log::info('[UploadThing] Using legacy multipart flow', [
                'url'    => $uploadData['url'],
                'fields' => array_keys($uploadData['fields'] ?? []),
            ]);

            $multipart = [];
            foreach (($uploadData['fields'] ?? []) as $key => $value) {
                $multipart[] = ['name' => $key, 'contents' => $value];
            }
            $multipart[] = [
                'name'     => 'file',
                'contents' => fopen($file->getRealPath(), 'r'),
                'filename' => $file->getClientOriginalName(),
                'headers'  => ['Content-Type' => $file->getMimeType()],
            ];

            $s3Response = (new Client())->post($uploadData['url'], ['multipart' => $multipart]);

            Log::info('[UploadThing] S3 multipart response', [
                'status' => $s3Response->getStatusCode(),
                'body'   => (string) $s3Response->getBody(),
            ]);

            if ($s3Response->getStatusCode() >= 400) {
                throw new RuntimeException('[UploadThing] Step 2 multipart POST failed.');
            }

        } else {
            throw new RuntimeException(
                '[UploadThing] Step 2: no presignedUrls or url found. uploadData: ' . json_encode($uploadData)
            );
        }

        // ── Step 3: return CDN URL ───────────────────────────────────────────
        $cdnUrl = $uploadData['ufsUrl'] ?? $uploadData['fileUrl'] ?? null;

        Log::info('[UploadThing] Upload complete', ['cdn_url' => $cdnUrl]);

        if (!$cdnUrl) {
            throw new RuntimeException(
                '[UploadThing] No CDN URL found in uploadData: ' . json_encode($uploadData)
            );
        }

        return $cdnUrl;
    }
}
