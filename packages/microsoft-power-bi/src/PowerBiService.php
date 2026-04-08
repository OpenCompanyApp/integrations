<?php

namespace OpenCompany\Integrations\PowerBi;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PowerBiService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.powerbi.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List workspaces (groups) the authenticated user has access to.
     *
     * @param  int  $top  Maximum number of workspaces to return.
     * @return array<string, mixed>
     */
    public function listWorkspaces(int $top = 100): array
    {
        return $this->request('GET', '/v1.0/myorg/groups', [
            '$top' => $top,
        ]);
    }

    /**
     * Get a single workspace (group) by its ID.
     *
     * @param  string  $id  The workspace (group) ID.
     * @return array<string, mixed>
     */
    public function getWorkspace(string $id): array
    {
        return $this->request('GET', '/v1.0/myorg/groups/' . urlencode($id));
    }

    /**
     * List datasets within a workspace.
     *
     * @param  string  $workspaceId  The workspace (group) ID.
     * @return array<string, mixed>
     */
    public function listDatasets(string $workspaceId): array
    {
        return $this->request('GET', '/v1.0/myorg/groups/' . urlencode($workspaceId) . '/datasets');
    }

    /**
     * Get a single dataset by its ID within a workspace.
     *
     * @param  string  $workspaceId  The workspace (group) ID.
     * @param  string  $datasetId    The dataset ID.
     * @return array<string, mixed>
     */
    public function getDataset(string $workspaceId, string $datasetId): array
    {
        return $this->request('GET', '/v1.0/myorg/groups/' . urlencode($workspaceId) . '/datasets/' . urlencode($datasetId));
    }

    /**
     * List reports within a workspace.
     *
     * @param  string  $workspaceId  The workspace (group) ID.
     * @return array<string, mixed>
     */
    public function listReports(string $workspaceId): array
    {
        return $this->request('GET', '/v1.0/myorg/groups/' . urlencode($workspaceId) . '/reports');
    }

    /**
     * Get a single report by its ID within a workspace.
     *
     * @param  string  $workspaceId  The workspace (group) ID.
     * @param  string  $reportId     The report ID.
     * @return array<string, mixed>
     */
    public function getReport(string $workspaceId, string $reportId): array
    {
        return $this->request('GET', '/v1.0/myorg/groups/' . urlencode($workspaceId) . '/reports/' . urlencode($reportId));
    }

    /**
     * Get the current authenticated user's profile information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1.0/myorg/profile');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g., /v1.0/myorg/groups).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Power BI REST API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the request fails or the service is not configured.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Power BI access token is not configured.');
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
                $error = $response->json('error.message')
                    ?? $response->json('error')
                    ?? $response->body();

                Log::error("Power BI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    "Power BI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Power BI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Power BI API: {$e->getMessage()}");
        }
    }
}
