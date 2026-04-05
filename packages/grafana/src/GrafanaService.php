<?php

namespace OpenCompany\Integrations\Grafana;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Grafana API service for communicating with a Grafana instance.
 *
 * Handles authentication via Bearer tokens and provides methods for
 * dashboards, datasources, teams, users, and alerts management.
 */
class GrafanaService
{
    /**
     * Create a new GrafanaService instance.
     *
     * @param string $apiToken The Grafana API token (Service Account or Personal Access Token).
     * @param string $hostname The Grafana instance hostname (e.g., "grafana.example.com").
     */
    public function __construct(
        private string $apiToken = '',
        private string $hostname = '',
    ) {
        $this->hostname = rtrim($this->hostname, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken) && !empty($this->hostname);
    }

    /**
     * Get the configured base URL for the Grafana API.
     */
    public function getBaseUrl(): string
    {
        return 'https://' . $this->hostname . '/api';
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

        return $this->request('GET', '/search', $params);
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

        return $this->request('POST', '/dashboards/db', $body);
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
     * Get a datasource by its ID.
     *
     * @param int $id The datasource ID.
     * @return array<string, mixed>
     */
    public function getDatasource(int $id): array
    {
        return $this->request('GET', '/datasources/' . $id);
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
     * Get a team by its ID.
     *
     * @param int $id The team ID.
     * @return array<string, mixed>
     */
    public function getTeam(int $id): array
    {
        return $this->request('GET', '/teams/' . $id);
    }

    /**
     * List organization users.
     *
     * @param int $page Page number (1-based).
     * @param int $limit Number of users per page.
     * @return array<string, mixed>
     */
    public function listUsers(int $page = 1, int $limit = 50): array
    {
        return $this->request('GET', '/org/users', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * List alerts, optionally filtered by dashboard and/or panel.
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
     * Get the current organization info (used for verifying authentication).
     *
     * @return array<string, mixed>
     */
    public function getOrg(): array
    {
        return $this->request('GET', '/org');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE).
     * @param string $path API path (relative to /api).
     * @param array<string, mixed> $data Query params (GET) or body data (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Grafana API.
     *
     * @param string $method HTTP method.
     * @param string $path API path relative to /api.
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

        if (!$this->hostname) {
            throw new \RuntimeException('Grafana hostname is not configured.');
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
                    throw new \RuntimeException("Grafana API endpoint not available (HTTP {$response->status()}). Check your hostname and API path.");
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
