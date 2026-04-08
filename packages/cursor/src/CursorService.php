<?php

namespace OpenCompany\Integrations\Cursor;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CursorService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api2.cursor.sh',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Cursor integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all workspaces accessible to the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/workspaces');
    }

    /**
     * Get details for a specific workspace.
     *
     * @param  string  $id  The workspace identifier.
     * @return array<string, mixed>
     */
    public function getWorkspace(string $id): array
    {
        return $this->request('GET', '/workspaces/' . urlencode($id));
    }

    /**
     * List all team members in a workspace.
     *
     * @param  string  $workspaceId  The workspace identifier.
     * @return array<string, mixed>
     */
    public function listTeamMembers(string $workspaceId): array
    {
        return $this->request('GET', '/workspaces/' . urlencode($workspaceId) . '/members');
    }

    /**
     * List all extensions installed in a workspace.
     *
     * @param  string  $workspaceId  The workspace identifier.
     * @return array<string, mixed>
     */
    public function listExtensions(string $workspaceId): array
    {
        return $this->request('GET', '/workspaces/' . urlencode($workspaceId) . '/extensions');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Cursor API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing, the request fails, or the response is unexpected.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Cursor API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                    Log::warning("Cursor API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Cursor API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Cursor API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Cursor API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Cursor API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Cursor API: {$e->getMessage()}");
        }
    }
}
