<?php

namespace OpenCompany\Integrations\Klipfolio;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Klipfolio API service for interacting with the Klipfolio dashboard analytics platform.
 *
 * Handles authentication via Bearer token and provides methods for managing
 * dashboards, metrics, data sources, and user information.
 *
 * @see https://support.klipfolio.com/hc/en-us/articles/115004 supplemental API docs
 */
class KlipfolioService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://app.klipfolio.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Klipfolio service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all dashboards accessible to the authenticated user.
     *
     * @param  int  $limit  Maximum number of dashboards to return per page (default: 25).
     * @param  int  $page   Page number for pagination (1-based, default: 1).
     * @return array<string, mixed> The API response containing dashboards and metadata.
     */
    public function listDashboards(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/api/v1/dashboards', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get details for a specific dashboard by its ID.
     *
     * @param  string  $id  The unique dashboard identifier.
     * @return array<string, mixed> The dashboard details.
     */
    public function getDashboard(string $id): array
    {
        return $this->request('GET', '/api/v1/dashboards/' . urlencode($id));
    }

    /**
     * List all metrics accessible to the authenticated user.
     *
     * @param  int  $limit  Maximum number of metrics to return per page (default: 25).
     * @param  int  $page   Page number for pagination (1-based, default: 1).
     * @return array<string, mixed> The API response containing metrics and metadata.
     */
    public function listMetrics(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/api/v1/metrics', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get details for a specific metric by its ID.
     *
     * @param  string  $id  The unique metric identifier.
     * @return array<string, mixed> The metric details.
     */
    public function getMetric(string $id): array
    {
        return $this->request('GET', '/api/v1/metrics/' . urlencode($id));
    }

    /**
     * List all data sources accessible to the authenticated user.
     *
     * @param  int  $limit  Maximum number of data sources to return per page (default: 25).
     * @param  int  $page   Page number for pagination (1-based, default: 1).
     * @return array<string, mixed> The API response containing data sources and metadata.
     */
    public function listDatasources(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/api/v1/datasources', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get details for a specific data source by its ID.
     *
     * @param  string  $id  The unique data source identifier.
     * @return array<string, mixed> The data source details.
     */
    public function getDatasource(string $id): array
    {
        return $this->request('GET', '/api/v1/datasources/' . urlencode($id));
    }

    /**
     * Get the currently authenticated user's profile information.
     *
     * @return array<string, mixed> The current user details.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/users/me');
    }

    /**
     * Make an API request and return the parsed JSON response.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g., '/api/v1/dashboards').
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Klipfolio API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Klipfolio access token is not configured.');
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
                    Log::warning("Klipfolio API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Klipfolio API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Klipfolio API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Klipfolio API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Klipfolio API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Klipfolio API: {$e->getMessage()}");
        }
    }
}
