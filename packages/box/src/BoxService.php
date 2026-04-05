<?php

namespace OpenCompany\Integrations\Box;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BoxService
{
    /**
     * Create a new BoxService instance.
     *
     * @param  string  $accessToken  Box API access token
     * @param  string  $baseUrl  Box API base URL
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.box.com/2.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List items in a folder.
     *
     * @param  string  $folderId  The folder ID (use "0" for root)
     * @param  int  $limit  Maximum number of items to return (1–1000)
     * @param  int  $offset  Zero-based offset for pagination
     * @return array<string, mixed>
     */
    public function listFiles(string $folderId = '0', int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', "/folders/{$folderId}/items", [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get metadata for a file.
     *
     * @param  string  $fileId  The file ID
     * @return array<string, mixed>
     */
    public function getFile(string $fileId): array
    {
        return $this->request('GET', "/files/{$fileId}");
    }

    /**
     * Upload a file to Box.
     *
     * @param  string  $content  File contents
     * @param  string  $fileName  Name for the file in Box
     * @param  string  $parentId  Parent folder ID (use "0" for root)
     * @return array<string, mixed>
     */
    public function uploadFile(string $content, string $fileName, string $parentId = '0'): array
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Box access token is not configured.');
        }

        $attributes = json_encode([
            'name' => $fileName,
            'parent' => ['id' => $parentId],
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])
            ->timeout(120)
            ->attach('attributes', $attributes, 'attributes', ['content-type' => 'application/json'])
            ->attach('file', $content, $fileName)
            ->post('https://upload.box.com/api/2.0/files/content');

        if (!$response->successful()) {
            $error = $response->json('message') ?? $response->body();
            Log::error('Box API upload error', [
                'status' => $response->status(),
                'error' => $error,
            ]);
            throw new \RuntimeException("Box API upload error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
        }

        return $response->json() ?? [];
    }

    /**
     * Download a file's contents.
     *
     * @param  string  $fileId  The file ID
     * @return string  The raw file contents
     */
    public function downloadFile(string $fileId): string
    {
        $response = $this->rawRequest('GET', "/files/{$fileId}/content");

        return $response->body();
    }

    /**
     * Delete a file.
     *
     * @param  string  $fileId  The file ID
     */
    public function deleteFile(string $fileId): void
    {
        $this->request('DELETE', "/files/{$fileId}");
    }

    /**
     * Create a new folder.
     *
     * @param  string  $name  The folder name
     * @param  string  $parentId  Parent folder ID (use "0" for root)
     * @return array<string, mixed>
     */
    public function createFolder(string $name, string $parentId = '0'): array
    {
        return $this->request('POST', '/folders', [
            'name' => $name,
            'parent' => ['id' => $parentId],
        ]);
    }

    /**
     * Get metadata for a folder.
     *
     * @param  string  $folderId  The folder ID
     * @return array<string, mixed>
     */
    public function getFolder(string $folderId): array
    {
        return $this->request('GET', "/folders/{$folderId}");
    }

    /**
     * Share a file by creating a shared link.
     *
     * @param  string  $fileId  The file ID
     * @param  array<string, mixed>  $settings  Shared link settings (access, password, expires_at, etc.)
     * @return array<string, mixed>
     */
    public function shareFile(string $fileId, array $settings = []): array
    {
        $body = ['shared_link' => empty($settings) ? (object) [] : $settings];

        return $this->request('PUT', "/files/{$fileId}", $body);
    }

    /**
     * Search for files and folders.
     *
     * @param  string  $query  The search query
     * @param  int  $limit  Maximum number of results (1–200)
     * @param  int  $offset  Zero-based offset for pagination
     * @return array<string, mixed>
     */
    public function search(string $query, int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/search', [
            'query' => $query,
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Query params or JSON body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($method === 'DELETE') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Box API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Query params or JSON body
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Box access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->withHeaders(['Content-Type' => 'application/json'])->post($url, $data),
                'PUT' => $http->withHeaders(['Content-Type' => 'application/json'])->put($url, $data),
                'DELETE' => $http->withHeaders(['Content-Type' => 'application/json'])->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Box API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Box API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the access token may be invalid.");
                }

                $error = $response->json('message') ?? $response->json('error.description') ?? $body;
                Log::error("Box API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Box API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Box API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Box API: {$e->getMessage()}");
        }
    }
}
