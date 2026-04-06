<?php

namespace OpenCompany\Integrations\Wildix;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WildixService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.wildix.com',
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
     * List calls with optional pagination and date filtering.
     *
     * @param  int  $limit   Maximum number of calls to return (default 25).
     * @param  int  $page    Page number for pagination (default 1).
     * @param  string|null  $dateFrom  Start date filter (ISO 8601, e.g. "2026-01-01").
     * @param  string|null  $dateTo    End date filter (ISO 8601, e.g. "2026-01-31").
     * @return array<string, mixed>
     */
    public function listCalls(int $limit = 25, int $page = 1, ?string $dateFrom = null, ?string $dateTo = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($dateFrom !== null) {
            $params['date_from'] = $dateFrom;
        }
        if ($dateTo !== null) {
            $params['date_to'] = $dateTo;
        }

        return $this->request('GET', '/api/v1/calls', $params);
    }

    /**
     * Get a single call by its ID.
     *
     * @param  string  $id  The call identifier.
     * @return array<string, mixed>
     */
    public function getCall(string $id): array
    {
        return $this->request('GET', '/api/v1/calls/' . urlencode($id));
    }

    /**
     * List extensions with optional pagination.
     *
     * @param  int  $limit  Maximum number of extensions to return (default 25).
     * @param  int  $page   Page number for pagination (default 1).
     * @return array<string, mixed>
     */
    public function listExtensions(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/api/v1/extensions', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single extension by its ID.
     *
     * @param  string  $id  The extension identifier.
     * @return array<string, mixed>
     */
    public function getExtension(string $id): array
    {
        return $this->request('GET', '/api/v1/extensions/' . urlencode($id));
    }

    /**
     * List users with optional pagination.
     *
     * @param  int  $limit  Maximum number of users to return (default 25).
     * @param  int  $page   Page number for pagination (default 1).
     * @return array<string, mixed>
     */
    public function listUsers(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/api/v1/users', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Wildix API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Wildix access token is not configured.');
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
                    Log::warning("Wildix API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Wildix API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Wildix API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Wildix API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Wildix API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Wildix API: {$e->getMessage()}");
        }
    }
}
