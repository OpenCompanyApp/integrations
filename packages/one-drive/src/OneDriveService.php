<?php

namespace OpenCompany\Integrations\OneDrive;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OneDriveService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://graph.microsoft.com/v1.0',
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
     * List files in the root of the user's OneDrive.
     *
     * @param  int  $top  Maximum number of items to return (default 100, max 999).
     * @param  string|null  $skipToken  Pagination token from a previous response.
     * @return array<string, mixed>
     */
    public function listFiles(int $top = 100, ?string $skipToken = null): array
    {
        $params = ['$top' => min($top, 999)];
        if ($skipToken) {
            $params['$skiptoken'] = $skipToken;
        }

        return $this->request('GET', '/me/drive/root/children', $params);
    }

    /**
     * Get metadata for a specific drive item by its ID.
     *
     * @param  string  $id  The unique identifier of the drive item.
     * @return array<string, mixed>
     */
    public function getFile(string $id): array
    {
        return $this->request('GET', '/me/drive/items/' . urlencode($id));
    }

    /**
     * Upload a file to OneDrive by path.
     *
     * For files up to 4 MB using the simple upload API.
     *
     * @param  string  $path  The destination path in OneDrive (e.g., "Documents/report.txt").
     * @param  string  $content  The file content.
     * @param  string  $contentType  The MIME type of the file (default: "application/octet-stream").
     * @return array<string, mixed>
     */
    public function uploadFile(string $path, string $content, string $contentType = 'application/octet-stream'): array
    {
        $url = $this->baseUrl . '/me/drive/root:/' . ltrim($path, '/') . ':/content';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type' => $contentType,
        ])->timeout(60)->withBody($content, $contentType)->put($url);

        if (!$response->successful()) {
            $this->handleError('PUT', '/me/drive/root:/' . ltrim($path, '/'), $response);
        }

        return $response->json() ?? [];
    }

    /**
     * Download a file's content by its drive item ID.
     *
     * Returns the raw file content as a string.
     *
     * @param  string  $id  The unique identifier of the drive item.
     * @return string The raw file content.
     */
    public function downloadFile(string $id): string
    {
        $url = $this->baseUrl . '/me/drive/items/' . urlencode($id) . '/content';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->timeout(120)->get($url);

        if (!$response->successful()) {
            $this->handleError('GET', '/me/drive/items/' . urlencode($id) . '/content', $response);
        }

        return $response->body();
    }

    /**
     * List files shared with the current user.
     *
     * @param  int  $top  Maximum number of items to return (default 100).
     * @param  string|null  $skipToken  Pagination token from a previous response.
     * @return array<string, mixed>
     */
    public function listShared(int $top = 100, ?string $skipToken = null): array
    {
        $params = ['$top' => min($top, 999)];
        if ($skipToken) {
            $params['$skiptoken'] = $skipToken;
        }

        return $this->request('GET', '/me/drive/shared', $params);
    }

    /**
     * Get the current authenticated user's profile.
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
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/me/drive/root/children").
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        $response = $this->rawRequest($method, $path, $params);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Microsoft Graph API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $params  Query parameters (for GET) or body (for POST/PUT).
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $params = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('OneDrive access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->handleError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OneDrive API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Microsoft Graph API: {$e->getMessage()}");
        }
    }

    /**
     * Handle an unsuccessful API response.
     *
     * @param  string  $method  HTTP method used.
     * @param  string  $path  API path requested.
     * @param  \Illuminate\Http\Client\Response  $response  The failed response.
     *
     * @throws \RuntimeException
     */
    private function handleError(string $method, string $path, \Illuminate\Http\Client\Response $response): void
    {
        $error = $response->json('error.message') ?? $response->body();

        Log::error("OneDrive API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new \RuntimeException("OneDrive API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
