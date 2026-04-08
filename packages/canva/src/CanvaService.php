<?php

namespace OpenCompany\Integrations\Canva;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CanvaService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.canva.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List designs the user has access to.
     *
     * @param  int  $limit  Maximum number of designs to return (1–100, default 50).
     * @param  string|null  $continuation  Cursor for pagination — pass the continuation token from a previous response.
     * @param  string|null  $query  Search query to filter designs by title.
     * @param  string|null  $type  Filter by design type (e.g., "presentation", "poster", "social_media", "video", "document").
     * @return array<string, mixed>
     */
    public function listDesigns(int $limit = 50, ?string $continuation = null, ?string $query = null, ?string $type = null): array
    {
        $params = ['limit' => $limit];
        if ($continuation !== null) {
            $params['continuation'] = $continuation;
        }
        if ($query !== null) {
            $params['query'] = $query;
        }
        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/v1/designs', $params);
    }

    /**
     * Get a single design by ID.
     *
     * @param  string  $designId  The design ID.
     * @return array<string, mixed>
     */
    public function getDesign(string $designId): array
    {
        return $this->request('GET', '/v1/designs/' . urlencode($designId));
    }

    /**
     * Create a new design.
     *
     * @param  string  $title  The title of the design.
     * @param  string|null  $type  The type of design (e.g., "presentation", "poster", "social_media").
     * @param  int|null  $width  Width in pixels.
     * @param  int|null  $height  Height in pixels.
     * @return array<string, mixed>
     */
    public function createDesign(string $title, ?string $type = null, ?int $width = null, ?int $height = null): array
    {
        $data = ['title' => $title];
        if ($type !== null) {
            $data['type'] = $type;
        }
        if ($width !== null) {
            $data['width'] = $width;
        }
        if ($height !== null) {
            $data['height'] = $height;
        }

        return $this->request('POST', '/v1/designs', $data);
    }

    /**
     * List folders the user has access to.
     *
     * @param  int  $limit  Maximum number of folders to return (1–100, default 50).
     * @param  string|null  $continuation  Cursor for pagination.
     * @return array<string, mixed>
     */
    public function listFolders(int $limit = 50, ?string $continuation = null): array
    {
        $params = ['limit' => $limit];
        if ($continuation !== null) {
            $params['continuation'] = $continuation;
        }

        return $this->request('GET', '/v1/folders', $params);
    }

    /**
     * Get a single folder by ID.
     *
     * @param  string  $folderId  The folder ID.
     * @return array<string, mixed>
     */
    public function getFolder(string $folderId): array
    {
        return $this->request('GET', '/v1/folders/' . urlencode($folderId));
    }

    /**
     * Upload an asset to Canva from a URL.
     *
     * @param  string  $fileUrl  The URL of the file to upload.
     * @param  string  $name  The name for the uploaded asset.
     * @param  string|null  $folderId  Optional folder ID to upload the asset into.
     * @return array<string, mixed>
     */
    public function uploadAsset(string $fileUrl, string $name, ?string $folderId = null): array
    {
        $data = [
            'file_url' => $fileUrl,
            'name' => $name,
        ];
        if ($folderId !== null) {
            $data['parent_folder_id'] = $folderId;
        }

        return $this->request('POST', '/v1/asset-uploads', $data);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/v1/designs").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Canva API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Canva access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Canva API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Canva API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the API version may have changed.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Canva API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Canva API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Canva API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Canva API: {$e->getMessage()}");
        }
    }
}
