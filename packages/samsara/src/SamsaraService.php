<?php

namespace OpenCompany\Integrations\Samsara;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SamsaraService
{
    /**
     * Create a new Samsara service instance.
     *
     * @param  string  $accessToken  Samsara API access token.
     * @param  string  $baseUrl  Samsara API base URL (default: https://api.samsara.com/v2).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.samsara.com/v2',
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
        return $this->request('GET', '/fleet/vehicles/' . urlencode($id));
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
        return $this->request('GET', '/fleet/drivers/' . urlencode($id));
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
     * Make an authenticated API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the request fails or the service is not configured.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Samsara API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If not configured, connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Samsara access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("Samsara API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException(
                    'Samsara API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Samsara API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Samsara API: {$e->getMessage()}");
        }
    }
}
