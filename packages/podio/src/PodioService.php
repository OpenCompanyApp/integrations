<?php

namespace OpenCompany\Integrations\Podio;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PodioService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.podio.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all spaces in an organization.
     *
     * @param int $orgId The organization ID
     * @return array<int, array<string, mixed>>
     */
    public function listSpaces(int $orgId): array
    {
        return $this->request('GET', "/space/org/{$orgId}");
    }

    /**
     * Get a single space by ID.
     *
     * @param int $spaceId The space ID
     * @return array<string, mixed>
     */
    public function getSpace(int $spaceId): array
    {
        return $this->request('GET', "/space/{$spaceId}");
    }

    /**
     * List all apps in a space.
     *
     * @param int $spaceId The space ID
     * @return array<int, array<string, mixed>>
     */
    public function listApps(int $spaceId): array
    {
        return $this->request('GET', "/app/space/{$spaceId}");
    }

    /**
     * Get a single app by ID.
     *
     * @param int $appId The app ID
     * @return array<string, mixed>
     */
    public function getApp(int $appId): array
    {
        return $this->request('GET', "/app/{$appId}");
    }

    /**
     * List items in an app with optional filtering and pagination.
     *
     * @param int $appId The app ID
     * @param array<string, mixed> $params Optional query parameters (filters, sorting, pagination)
     * @return array<string, mixed>
     */
    public function listItems(int $appId, array $params = []): array
    {
        return $this->request('POST', "/item/app/{$appId}/filter", $params);
    }

    /**
     * Get a single item by ID.
     *
     * @param int $itemId The item ID
     * @return array<string, mixed>
     */
    public function getItem(int $itemId): array
    {
        return $this->request('GET', "/item/{$itemId}");
    }

    /**
     * Get the current authenticated user's status.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user/status');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param string $path API endpoint path
     * @param array<string, mixed> $data Request body or query parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Podio API.
     *
     * @param string $method HTTP method
     * @param string $path API endpoint path
     * @param array<string, mixed> $data Request body or query parameters
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing or the request fails
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Podio access token is not configured.');
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
                    Log::warning("Podio API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Podio API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
                }

                $error = $response->json('error_description') ?? $response->json('error') ?? $body;
                Log::error("Podio API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Podio API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Podio API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Podio API: {$e->getMessage()}");
        }
    }
}
