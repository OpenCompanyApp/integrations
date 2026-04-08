<?php

namespace OpenCompany\Integrations\Split;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SplitService
{
    public function __construct(
        private string $accessToken = '',
        private string $workspaceId = '',
        private string $baseUrl = 'https://api.split.io/internal/api/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the configured workspace ID.
     */
    public function getWorkspaceId(): string
    {
        return $this->workspaceId;
    }

    /**
     * List splits for a workspace (paginated).
     *
     * @param  string|null  $workspaceId  Override the default workspace ID
     * @param  int  $limit  Maximum number of splits to return (default: 20, max: 100)
     * @param  int  $offset  Offset for pagination (default: 0)
     * @return array<string, mixed>
     */
    public function listSplits(?string $workspaceId = null, int $limit = 20, int $offset = 0): array
    {
        $wsId = $workspaceId ?? $this->workspaceId;

        return $this->request('GET', "/splits/ws/{$wsId}", [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single split by name.
     *
     * @param  string  $splitName  The split name
     * @param  string|null  $workspaceId  Override the default workspace ID
     * @return array<string, mixed>
     */
    public function getSplit(string $splitName, ?string $workspaceId = null): array
    {
        $wsId = $workspaceId ?? $this->workspaceId;

        return $this->request('GET', "/splits/ws/{$wsId}/{$splitName}");
    }

    /**
     * Create a new split in a workspace.
     *
     * @param  string  $name  The split name
     * @param  string  $trafficTypeName  The traffic type name (e.g., "user")
     * @param  string|null  $description  Optional description
     * @param  string|null  $workspaceId  Override the default workspace ID
     * @return array<string, mixed>
     */
    public function createSplit(string $name, string $trafficTypeName, ?string $description = null, ?string $workspaceId = null): array
    {
        $wsId = $workspaceId ?? $this->workspaceId;

        $body = [
            'name' => $name,
            'trafficTypeName' => $trafficTypeName,
        ];

        if ($description !== null) {
            $body['description'] = $description;
        }

        return $this->request('POST', "/splits/ws/{$wsId}", $body, true);
    }

    /**
     * List environments for a workspace.
     *
     * @param  string|null  $workspaceId  Override the default workspace ID
     * @return array<string, mixed>
     */
    public function listEnvironments(?string $workspaceId = null): array
    {
        $wsId = $workspaceId ?? $this->workspaceId;

        return $this->request('GET', "/environments/ws/{$wsId}");
    }

    /**
     * Get a single environment by ID.
     *
     * @param  string  $environmentId  The environment ID
     * @param  string|null  $workspaceId  Override the default workspace ID
     * @return array<string, mixed>
     */
    public function getEnvironment(string $environmentId, ?string $workspaceId = null): array
    {
        $wsId = $workspaceId ?? $this->workspaceId;

        return $this->request('GET', "/environments/ws/{$wsId}/{$environmentId}");
    }

    /**
     * List all workspaces.
     *
     * @return array<string, mixed>
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/workspaces');
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
     * @param  string  $method  HTTP method
     * @param  string  $path  API path (relative to base URL)
     * @param  array<int|string, mixed>  $data  Query params or request body
     * @param  bool  $isBody  If true, send $data as JSON body; otherwise as query params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $isBody = false): array
    {
        $response = $this->rawRequest($method, $path, $data, $isBody);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Split API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<int|string, mixed>  $data  Request data
     * @param  bool  $isBody  Send as JSON body instead of query params
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $isBody = false): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Split access token is not configured.');
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
                'PATCH' => $http->withBody(json_encode($data), 'application/json')->patch($url),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Split API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Split API endpoint not available (HTTP {$response->status()}). Check your base URL and access token.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("Split API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Split API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Split API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Split API: {$e->getMessage()}");
        }
    }
}
