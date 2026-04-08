<?php

namespace OpenCompany\Integrations\GoogleDrive;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Google Drive API service.
 *
 * Handles authenticated requests to the Google Drive v3 REST API
 * using a Bearer access token.
 */
class GoogleDriveService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://www.googleapis.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an access token configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List files in the user's Google Drive.
     *
     * @param  array<string, mixed>  $params  Query parameters (pageSize, pageToken, q, spaces, trashed, corpora, etc.)
     * @return array<string, mixed>
     */
    public function listFiles(array $params = []): array
    {
        return $this->request('GET', '/drive/v3/files', $params);
    }

    /**
     * Get metadata for a single file by ID.
     *
     * @param  string  $fileId  The Google Drive file ID.
     * @param  array<string, mixed>  $params  Query parameters (fields, etc.)
     * @return array<string, mixed>
     */
    public function getFile(string $fileId, array $params = []): array
    {
        return $this->request('GET', '/drive/v3/files/' . urlencode($fileId), $params);
    }

    /**
     * Create a new file in Google Drive.
     *
     * @param  array<string, mixed>  $body  Request body (name, mimeType, parents, etc.)
     * @return array<string, mixed>
     */
    public function createFile(array $body = []): array
    {
        return $this->request('POST', '/drive/v3/files', [], $body);
    }

    /**
     * Create a new folder in Google Drive.
     *
     * Sets the mimeType to `application/vnd.google-apps.folder`.
     *
     * @param  string  $name  The folder name.
     * @param  string|null  $parentId  Optional parent folder ID.
     * @return array<string, mixed>
     */
    public function createFolder(string $name, ?string $parentId = null): array
    {
        $body = [
            'name' => $name,
            'mimeType' => 'application/vnd.google-apps.folder',
        ];

        if ($parentId !== null) {
            $body['parents'] = [$parentId];
        }

        return $this->request('POST', '/drive/v3/files', [], $body);
    }

    /**
     * List changes to files in Google Drive.
     *
     * @param  array<string, mixed>  $params  Query parameters (pageSize, pageToken, etc.)
     * @return array<string, mixed>
     */
    public function listChanges(array $params = []): array
    {
        return $this->request('GET', '/drive/v3/changes', $params);
    }

    /**
     * Get information about the current user and Drive settings.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/drive/v3/about', ['fields' => 'user,storageQuota']);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. /drive/v3/files).
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Google Drive API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException  On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Google Drive access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->withQueryParameters($query)->post($url, $body),
                'PUT' => $http->withQueryParameters($query)->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->body();
                Log::error("Google Drive API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Google Drive API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Drive API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Google Drive API: {$e->getMessage()}");
        }
    }
}
