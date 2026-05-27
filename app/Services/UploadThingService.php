<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class UploadThingService
{
    private string $apiKey;
    private string $baseUrl = 'https://api.uploadthing.com/v6';

    public function __construct()
    {
        $this->apiKey = config('services.uploadthing.secret');
    }

    /**
     * Upload a file to UploadThing and return the public CDN URL.
     */
    public function upload(UploadedFile $file): string
    {
        // Step 1 — Request a presigned upload URL from UploadThing
        $response = Http::withHeaders([
            'X-Uploadthing-Api-Key' => $this->apiKey,
            'Content-Type'          => 'application/json',
        ])->post("{$this->baseUrl}/uploadFiles", [
            'files' => [[
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'type' => $file->getMimeType(),
            ]],
            'acl' => 'public-read',
        ]);

        if ($response->failed()) {
            throw new RuntimeException('UploadThing: failed to get presigned URL — ' . $response->body());
        }

        $uploadInfo = $response->json('data.0');

        // Step 2 — POST the file to the S3 presigned URL with all required fields
        $multipart = [];

        foreach ($uploadInfo['fields'] as $key => $value) {
            $multipart[] = ['name' => $key, 'contents' => $value];
        }

        $multipart[] = [
            'name'     => 'file',
            'contents' => fopen($file->getRealPath(), 'r'),
            'filename' => $file->getClientOriginalName(),
            'headers'  => ['Content-Type' => $file->getMimeType()],
        ];

        $client = new Client();
        $s3Response = $client->post($uploadInfo['url'], [
            'multipart' => $multipart,
        ]);

        if ($s3Response->getStatusCode() >= 400) {
            throw new RuntimeException('UploadThing: S3 upload failed.');
        }

        // The public CDN URL is returned immediately from Step 1
        return $uploadInfo['fileUrl'];
    }
}
