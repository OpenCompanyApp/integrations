<?php

namespace OpenCompany\Integrations\Grafana;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Grafana API service for communicating with Grafana Cloud.
 *
 * Handles authentication via Bearer tokens against the
 * Grafana Cloud API at https://api.grafana.com/v1.
 */
class GrafanaService
{
    /**
     * Create a new GrafanaService instance.
     *
     * @param string $apiToken The Grafana Cloud API token (Bearer token).
     */
    public function __construct(
        private string $apiToken = '',
    ) {}

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    /**
     * Get the configured base URL for the Grafana Cloud API.
     */
    public function getBaseUrl(): string
    {
        return 'https://api.grafana.com/v1';
    }

    /**
     * Search for dashboards.
     *
     * @param string|null $query Search query to filter dashboards.
     * @param string $type Dashboard type filter (default: "dash-db").
     * @param int $limit Maximum number of results.
     * @return array<string, mixed>
     */
    public function listDashboards(?string $query = null, string $type = 'dash-db', int $limit = 100): array
    {
        $params = ['type' => $type, 'limit' => $limit];
        if ($query !== null) {
            $params['query'] = $query;
        }

        return $this->request('GET', '/dashboards', $params);
    }

    /**
     * Get a dashboard by its UID.
     *
     * @param string $uid The dashboard UID.
     * @return array<string, mixed>
     */
    public function getDashboard(string $uid): array
    {
        return $this->request('GET', '/dashboards/uid/' . urlencode($uid));
    }

    /**
     * Create or update a dashboard.
     *
     * @param array<string, mixed> $dashboard The dashboard JSON object.
     * @param string $folderUid The UID of the folder to place the dashboard in.
     * @param bool $overwrite Whether to overwrite an existing dashboard with the same slug.
     * @return array<string, mixed>
     */
    public function createDashboard(array $dashboard, string $folderUid = '', bool $overwrite = false): array
    {
        $body = [
            'dashboard' => $dashboard,
            'overwrite' => $overwrite,
        ];

        if ($folderUid !== '') {
            $body['folderUid'] = $folderUid;
        }

        return $this->request('POST', '/dashboards', $body);
    }

    /**
     * List all datasources.
     *
     * @return array<string, mixed>
     */
    public function listDatasources(): array
    {
        return $this->request('GET', '/datasources');
    }

    /**
     * List all alerts.
     *
     * @param int|null $dashboardId Filter by dashboard ID.
     * @param int|null $panelId Filter by panel ID.
     * @return array<string, mixed>
     */
    public function listAlerts(?int $dashboardId = null, ?int $panelId = null): array
    {
        $params = [];
        if ($dashboardId !== null) {
            $params['dashboardId'] = $dashboardId;
        }
        if ($panelId !== null) {
            $params['panelId'] = $panelId;
        }

        return $this->request('GET', '/alerts', $params);
    }

    /**
     * List all teams.
     *
     * @param int $page Page number (1-based).
     * @param int $perPage Number of teams per page.
     * @return array<string, mixed>
     */
    public function listTeams(int $page = 1, int $perPage = 50): array
    {
        return $this->request('GET', '/teams', [
            'page' => $page,
            'perpage' => $perPage,
        ]);
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE).
     * @param string $path API path (relative to base URL).
     * @param array<string, mixed> $data Query params (GET) or body data (POST/PUT).
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
     * Make a raw HTTP request to the Grafana Cloud API.
     *
     * @param string $method HTTP method.
     * @param string $path API path relative to base URL.
     * @param array<string, mixed> $data Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API token is not configured or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('Grafana API token is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Grafana API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Grafana API endpoint not available (HTTP {$response->status()}). Check your API token and path.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Grafana API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Grafana API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Grafana API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Grafana API: {$e->getMessage()}");
        }
    }
}
