<?php

namespace OpenCompany\Integrations\GoogleDocs;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the Google Docs API and Drive API.
 *
 * Handles authentication via Bearer token and provides methods for
 * managing documents, permissions, and user information.
 */
class GoogleDocsService
{
    /**
     * Create a new GoogleDocsService instance.
     *
     * @param  string  $accessToken  OAuth2 access token for Google APIs.
     * @param  string  $baseUrl  Base URL for the Google Docs API (default: https://docs.googleapis.com).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://docs.googleapis.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List documents visible to the authenticated user.
     *
     * Uses the Google Drive API to list Google Docs files.
     *
     * @param  int  $pageSize  Maximum number of files to return per page (default: 100).
     * @param  string|null  $pageToken  Token for the next page of results.
     * @param  string|null  $q  Drive API query string for filtering files.
     * @return array<string, mixed> The API response containing files and optional next page token.
     */
    public function listDocuments(int $pageSize = 100, ?string $pageToken = null, ?string $q = null): array
    {
        $params = [
            'pageSize' => $pageSize,
            'fields' => 'nextPageToken,files(id,name,mimeType,createdTime,modifiedTime,owners,webViewLink)',
        ];

        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }

        if ($q !== null) {
            $params['q'] = $q;
        } else {
            $params['q'] = "mimeType='application/vnd.google-apps.document'";
        }

        return $this->request('GET', 'https://www.googleapis.com/drive/v3/files', $params);
    }

    /**
     * Get a single document by its ID.
     *
     * @param  string  $documentId  The Google Docs document ID.
     * @return array<string, mixed> The full document resource including content and styling.
     */
    public function getDocument(string $documentId): array
    {
        return $this->request('GET', $this->baseUrl . '/v1/documents/' . urlencode($documentId));
    }

    /**
     * Create a new Google Docs document.
     *
     * @param  string  $title  The title of the new document.
     * @return array<string, mixed> The created document resource.
     */
    public function createDocument(string $title): array
    {
        return $this->request('POST', $this->baseUrl . '/v1/documents', [
            'title' => $title,
        ]);
    }

    /**
     * Send a batch update to a document (insert text, styling, etc.).
     *
     * @param  string  $documentId  The document ID to update.
     * @param  array<int, array<string, mixed>>  $requests  Array of Google Docs API request objects.
     * @return array<string, mixed> The batch update response.
     */
    public function batchUpdate(string $documentId, array $requests): array
    {
        return $this->request('POST', $this->baseUrl . '/v1/documents/' . urlencode($documentId) . ':batchUpdate', [
            'requests' => $requests,
        ]);
    }

    /**
     * List permissions for a file (uses the Drive API).
     *
     * @param  string  $fileId  The Drive file ID.
     * @param  int  $pageSize  Maximum number of permissions to return (default: 100).
     * @return array<string, mixed> The permissions list response.
     */
    public function listPermissions(string $fileId, int $pageSize = 100): array
    {
        return $this->request('GET', 'https://www.googleapis.com/drive/v3/files/' . urlencode($fileId) . '/permissions', [
            'pageSize' => $pageSize,
            'fields' => 'nextPageToken,permissions(id,type,emailAddress,role,displayName)',
        ]);
    }

    /**
     * Get a specific permission for a file (uses the Drive API).
     *
     * @param  string  $fileId  The Drive file ID.
     * @param  string  $permissionId  The permission ID to retrieve.
     * @return array<string, mixed> The permission resource.
     */
    public function getPermission(string $fileId, string $permissionId): array
    {
        return $this->request('GET', 'https://www.googleapis.com/drive/v3/files/' . urlencode($fileId) . '/permissions/' . urlencode($permissionId));
    }

    /**
     * Get the authenticated user's profile information.
     *
     * @return array<string, mixed> The user info response (id, email, name, picture).
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', 'https://www.googleapis.com/oauth2/v2/userinfo');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $url  Full URL for the request.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $url, array $data = []): array
    {
        $response = $this->rawRequest($method, $url, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to a Google API endpoint.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $url  Full URL for the request.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $url, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Google Docs access token is not configured.');
        }

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
                $error = $response->json('error.message') ?? $response->body();
                Log::error("Google Docs API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Google Docs API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Docs API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Google Docs API: {$e->getMessage()}");
        }
    }
}
