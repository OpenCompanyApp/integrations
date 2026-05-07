<?php

namespace OpenCompany\Integrations\OneDrive;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Microsoft OneDrive through Microsoft Graph.
 *
 * Handles delegated-token requests, DriveItem operations, sharing, delta sync,
 * and generic relative Graph calls for uncovered endpoints.
 */
class OneDriveService
{
    /**
     * @param  string  $accessToken  Microsoft Graph delegated access token.
     * @param  string  $baseUrl  Microsoft Graph API base URL.
     */
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
        return $this->request('GET', '/me/drive/items/' . rawurlencode($id));
    }

    /**
     * Get metadata for the signed-in user's default drive.
     *
     * @return array<string, mixed>
     */
    public function getDrive(): array
    {
        return $this->request('GET', '/me/drive');
    }

    /**
     * List children of the root folder or a specific drive item.
     *
     * @param  string|null  $parentId  Parent drive item ID. Null lists root children.
     * @param  int  $top  Maximum number of items to return.
     * @param  string|null  $skipToken  Pagination token from a previous response.
     * @return array<string, mixed>
     */
    public function listChildren(?string $parentId = null, int $top = 100, ?string $skipToken = null): array
    {
        $params = ['$top' => min($top, 999)];
        if ($skipToken) {
            $params['$skiptoken'] = $skipToken;
        }

        $path = $parentId
            ? '/me/drive/items/' . rawurlencode($parentId) . '/children'
            : '/me/drive/root/children';

        return $this->request('GET', $path, $params);
    }

    /**
     * Create a folder under the root folder or a specific parent item.
     *
     * @param  string  $name  Folder name.
     * @param  string|null  $parentId  Parent drive item ID. Null creates under root.
     * @param  string  $conflictBehavior  Graph conflict behavior: rename, replace, or fail.
     * @return array<string, mixed>
     */
    public function createFolder(string $name, ?string $parentId = null, string $conflictBehavior = 'rename'): array
    {
        $path = $parentId
            ? '/me/drive/items/' . rawurlencode($parentId) . '/children'
            : '/me/drive/root/children';

        return $this->request('POST', $path, [
            'name' => $name,
            'folder' => (object) [],
            '@microsoft.graph.conflictBehavior' => $conflictBehavior,
        ]);
    }

    /**
     * Update DriveItem metadata such as name, description, parentReference, or fileSystemInfo.
     *
     * @param  string  $id  Drive item ID.
     * @param  array<string, mixed>  $payload  Graph DriveItem update payload.
     * @return array<string, mixed>
     */
    public function updateItem(string $id, array $payload): array
    {
        return $this->request('PATCH', '/me/drive/items/' . rawurlencode($id), $payload);
    }

    /**
     * Delete a DriveItem.
     *
     * @param  string  $id  Drive item ID.
     * @return array<string, mixed>
     */
    public function deleteItem(string $id): array
    {
        return $this->request('DELETE', '/me/drive/items/' . rawurlencode($id));
    }

    /**
     * Copy a DriveItem asynchronously.
     *
     * @param  string  $id  Drive item ID.
     * @param  array<string, mixed>  $payload  Copy request body.
     * @return array<string, mixed>
     */
    public function copyItem(string $id, array $payload): array
    {
        $response = $this->rawRequest('POST', '/me/drive/items/' . rawurlencode($id) . '/copy', $payload);

        return $response->json() ?? [
            'accepted' => $response->successful(),
            'status' => $response->status(),
            'monitor_url' => $response->header('Location'),
        ];
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
        $url = $this->baseUrl . '/me/drive/root:/' . $this->encodePath($path) . ':/content';

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
        $url = $this->baseUrl . '/me/drive/items/' . rawurlencode($id) . '/content';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])->timeout(120)->get($url);

        if (!$response->successful()) {
            $this->handleError('GET', '/me/drive/items/' . rawurlencode($id) . '/content', $response);
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
        return $this->request('GET', '/me');
    }

    /**
     * Search the signed-in user's OneDrive.
     *
     * @param  string  $query  Search text.
     * @return array<string, mixed>
     */
    public function search(string $query): array
    {
        $safeQuery = str_replace("'", "''", $query);

        return $this->request('GET', "/me/drive/root/search(q='" . rawurlencode($safeQuery) . "')");
    }

    /**
     * List changes in the signed-in user's drive.
     *
     * @param  array<string, mixed>  $params  Delta query parameters.
     * @return array<string, mixed>
     */
    public function delta(array $params = []): array
    {
        return $this->request('GET', '/me/drive/root/delta', $params);
    }

    /**
     * List thumbnail sets for a DriveItem.
     *
     * @param  string  $id  Drive item ID.
     * @return array<string, mixed>
     */
    public function listThumbnails(string $id): array
    {
        return $this->request('GET', '/me/drive/items/' . rawurlencode($id) . '/thumbnails');
    }

    /**
     * Create or return a sharing link for a DriveItem.
     *
     * @param  string  $id  Drive item ID.
     * @param  array<string, mixed>  $payload  Graph createLink payload.
     * @return array<string, mixed>
     */
    public function createSharingLink(string $id, array $payload): array
    {
        return $this->request('POST', '/me/drive/items/' . rawurlencode($id) . '/createLink', $payload);
    }

    /**
     * List sharing permissions for a DriveItem.
     *
     * @param  string  $id  Drive item ID.
     * @return array<string, mixed>
     */
    public function listPermissions(string $id): array
    {
        return $this->request('GET', '/me/drive/items/' . rawurlencode($id) . '/permissions');
    }

    /**
     * Delete a sharing permission from a DriveItem.
     *
     * @param  string  $itemId  Drive item ID.
     * @param  string  $permissionId  Permission ID.
     * @return array<string, mixed>
     */
    public function deletePermission(string $itemId, string $permissionId): array
    {
        return $this->request('DELETE', '/me/drive/items/' . rawurlencode($itemId) . '/permissions/' . rawurlencode($permissionId));
    }

    /**
     * Send a GET request to a relative Microsoft Graph path.
     *
     * @param  string  $path  Relative Graph path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to a relative Microsoft Graph path.
     *
     * @param  string  $path  Relative Graph path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PATCH request to a relative Microsoft Graph path.
     *
     * @param  string  $path  Relative Graph path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to a relative Microsoft Graph path.
     *
     * @param  string  $path  Relative Graph path.
     * @param  array<string, mixed>  $payload  Optional JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, PATCH, DELETE).
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
            throw new RuntimeException('OneDrive access token is not configured.');
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
                'PATCH' => $http->patch($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->handleError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("OneDrive API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Microsoft Graph API: {$e->getMessage()}");
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

        throw new RuntimeException("OneDrive API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }

    /**
     * Encode an upload path while preserving path separators.
     */
    private function encodePath(string $path): string
    {
        return implode('/', array_map('rawurlencode', explode('/', ltrim($path, '/'))));
    }

    /**
     * Normalize and validate a caller-supplied relative Graph path.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || str_contains($path, '://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Microsoft Graph path must be relative, such as /me/drive.');
        }

        return str_starts_with($path, '/') ? $path : '/'.$path;
    }
}
