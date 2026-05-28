<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class CloudinaryService
{
    private string $cloudName;
    private string $apiKey;
    private string $apiSecret;

    public function __construct()
    {
        $this->cloudName = config('services.cloudinary.cloud_name');
        $this->apiKey    = config('services.cloudinary.api_key');
        $this->apiSecret = config('services.cloudinary.api_secret');
    }

    public function upload(UploadedFile $file): string
    {
        $timestamp = time();
        $signature = sha1("timestamp={$timestamp}{$this->apiSecret}");

        $response = Http::attach(
            'file',
            file_get_contents($file->getPathname()),
            $file->getClientOriginalName()
        )->post("https://api.cloudinary.com/v1_1/{$this->cloudName}/image/upload", [
            'api_key'   => $this->apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ]);

        if ($response->failed()) {
            throw new RuntimeException('Cloudinary upload failed: ' . $response->body());
        }

        return $response->json('secure_url');
    }
}
