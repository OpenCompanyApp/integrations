<?php

namespace OpenCompany\Integrations\Svix;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SvixService
{
    public function __construct(
        private string $authToken = '',
        private string $baseUrl = 'https://api.svix.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->authToken);
    }

    /**
     * List applications.
     *
     * @param  int  $limit  Maximum number of items to return (default 50, max 250).
     * @param  string|null  $iterator  Cursor for pagination — pass the iterator from a previous response.
     * @return array<string, mixed>
     */
    public function listApplications(int $limit = 50, ?string $iterator = null): array
    {
        $params = ['limit' => $limit];
        if ($iterator !== null) {
            $params['iterator'] = $iterator;
        }

        return $this->request('GET', '/api/v1/app', $params);
    }

    /**
     * Get an application by ID.
     *
     * @param  string  $id  The application ID.
     * @return array<string, mixed>
     */
    public function getApplication(string $id): array
    {
        return $this->request('GET', '/api/v1/app/' . urlencode($id));
    }

    /**
     * Create a new application.
     *
     * @param  string  $name  The application name.
     * @param  string|null  $uid  Optional unique identifier for the application.
     * @return array<string, mixed>
     */
    public function createApplication(string $name, ?string $uid = null): array
    {
        $data = ['name' => $name];
        if ($uid !== null) {
            $data['uid'] = $uid;
        }

        return $this->request('POST', '/api/v1/app', $data);
    }

    /**
     * List messages for an application.
     *
     * @param  string  $appId  The application ID.
     * @param  int  $limit  Maximum number of items to return (default 50, max 250).
     * @param  string|null  $iterator  Cursor for pagination.
     * @return array<string, mixed>
     */
    public function listMessages(string $appId, int $limit = 50, ?string $iterator = null): array
    {
        $params = ['limit' => $limit];
        if ($iterator !== null) {
            $params['iterator'] = $iterator;
        }

        return $this->request('GET', '/api/v1/app/' . urlencode($appId) . '/msg', $params);
    }

    /**
     * List endpoints for an application.
     *
     * @param  string  $appId  The application ID.
     * @param  int  $limit  Maximum number of items to return (default 50, max 250).
     * @param  string|null  $iterator  Cursor for pagination.
     * @return array<string, mixed>
     */
    public function listEndpoints(string $appId, int $limit = 50, ?string $iterator = null): array
    {
        $params = ['limit' => $limit];
        if ($iterator !== null) {
            $params['iterator'] = $iterator;
        }

        return $this->request('GET', '/api/v1/app/' . urlencode($appId) . '/endpoint', $params);
    }

    /**
     * Create an endpoint for an application.
     *
     * @param  string  $appId  The application ID.
     * @param  string  $url  The endpoint URL.
     * @param  int  $version  The API version for the endpoint (e.g., 1).
     * @param  string|null  $description  Optional description for the endpoint.
     * @return array<string, mixed>
     */
    public function createEndpoint(string $appId, string $url, int $version = 1, ?string $description = null): array
    {
        $data = [
            'url' => $url,
            'version' => $version,
        ];
        if ($description !== null) {
            $data['description'] = $description;
        }

        return $this->request('POST', '/api/v1/app/' . urlencode($appId) . '/endpoint', $data);
    }

    /**
     * Get the current authenticated user's dashboard usage information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/dashboard-usage/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., /api/v1/app).
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Svix API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->authToken) {
            throw new \RuntimeException('Svix authentication token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->authToken,
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
                    Log::warning("Svix API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Svix API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('detail') ?? $response->json('error') ?? $body;
                Log::error("Svix API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Svix API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Svix API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Svix API: {$e->getMessage()}");
        }
    }
}
