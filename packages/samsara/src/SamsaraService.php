<?php

namespace OpenCompany\Integrations\Samsara;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Samsara REST API.
 *
 * Handles bearer-token authentication, current unversioned API paths, legacy
 * v2-compatible configuration, response parsing, and error normalization.
 */
class SamsaraService
{
    /**
     * Create a new Samsara service instance.
     *
     * @param  string  $accessToken  Samsara API access token.
     * @param  string  $baseUrl  Samsara API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.samsara.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Samsara integration is configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    /**
     * List vehicles with pagination support.
     *
     * @param  int  $limit  Maximum number of vehicles to return per page (max 512).
     * @param  string|null  $after  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listVehicles(int $limit = 100, ?string $after = null): array
    {
        $params = ['limit' => min($limit, 512)];
        if ($after !== null) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/fleet/vehicles', $params);
    }

    /**
     * Get a single vehicle by ID.
     *
     * @param  string  $id  The Samsara vehicle ID.
     * @return array<string, mixed>
     */
    public function getVehicle(string $id): array
    {
        return $this->request('GET', '/fleet/vehicles/' . rawurlencode($id));
    }

    /**
     * List drivers with pagination support.
     *
     * @param  int  $limit  Maximum number of drivers to return per page (max 512).
     * @param  string|null  $after  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listDrivers(int $limit = 100, ?string $after = null): array
    {
        $params = ['limit' => min($limit, 512)];
        if ($after !== null) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/fleet/drivers', $params);
    }

    /**
     * Get a single driver by ID.
     *
     * @param  string  $id  The Samsara driver ID.
     * @return array<string, mixed>
     */
    public function getDriver(string $id): array
    {
        return $this->request('GET', '/fleet/drivers/' . rawurlencode($id));
    }

    /**
     * List sensors with pagination support.
     *
     * @param  int  $limit  Maximum number of sensors to return per page (max 512).
     * @param  string|null  $after  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listSensors(int $limit = 100, ?string $after = null): array
    {
        $params = ['limit' => min($limit, 512)];
        if ($after !== null) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/sensors', $params);
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
     * Execute a safe relative GET request.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Execute a safe relative POST request.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $body, $query);
    }

    /**
     * Execute a safe relative PATCH request.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PATCH', $path, $body, $query);
    }

    /**
     * Execute a safe relative DELETE request.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, [], $query);
    }

    /**
     * Make an authenticated API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @param  array<string, mixed>  $query  Query string parameters for non-GET methods.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the request fails or the service is not configured.
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Samsara API.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @param  array<string, mixed>  $query  Query string parameters for non-GET methods.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If not configured, connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): \Illuminate\Http\Client\Response
    {
        if (! $this->accessToken) {
            throw new RuntimeException('Samsara access token is not configured.');
        }

        $method = strtoupper($method);
        $path = $this->safeRelativePath($path);
        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match ($method) {
                'GET' => $http->get($this->urlWithQuery($url, $data)),
                'POST' => $http->post($this->urlWithQuery($url, $query), $data),
                'PATCH' => $http->patch($this->urlWithQuery($url, $query), $data),
                'PUT' => $http->put($this->urlWithQuery($url, $query), $data),
                'DELETE' => $http->delete($this->urlWithQuery($url, $query)),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("Samsara API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException(
                    'Samsara API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Samsara API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Samsara API: {$e->getMessage()}");
        }
    }

    /**
     * Validate a relative API path.
     */
    private function safeRelativePath(string $path): string
    {
        if ($path === '' || str_contains($path, '://')) {
            throw new RuntimeException('Samsara API path must be a relative path.');
        }

        $path = '/' . ltrim($path, '/');
        if (str_contains($path, '..')) {
            throw new RuntimeException('Samsara API path cannot contain parent directory traversal.');
        }

        return $path;
    }

    /**
     * Remove empty query values.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    private function filterEmpty(array $query): array
    {
        return array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');
    }

    /**
     * Append query parameters while preserving repeated values.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];

        foreach ($this->filterEmpty($query) as $key => $value) {
            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item !== null && $item !== '') {
                    $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $item);
                }
            }
        }

        return $parts === [] ? $url : $url . '?' . implode('&', $parts);
    }
}
