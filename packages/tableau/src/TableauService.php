<?php

namespace OpenCompany\Integrations\Tableau;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TableauService
{
    public function __construct(
        private string $accessToken = '',
        private string $siteId = '',
        private string $baseUrl = 'https://your-tableau-server.com/api/3.23',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has the minimum required configuration.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->siteId);
    }

    /**
     * Get the configured site ID.
     */
    public function getSiteId(): string
    {
        return $this->siteId;
    }

    /**
     * List workbooks on the configured site.
     *
     * @param  int  $pageSize  Number of workbooks per page (max 1000).
     * @param  int  $pageNumber  Page number (1-based).
     * @return array<string, mixed>
     */
    public function listWorkbooks(int $pageSize = 100, int $pageNumber = 1): array
    {
        return $this->request('GET', "/sites/{$this->siteId}/workbooks", [
            'pageSize' => $pageSize,
            'pageNumber' => $pageNumber,
        ]);
    }

    /**
     * Get a single workbook by ID.
     *
     * @param  string  $workbookId  The workbook LUID.
     * @return array<string, mixed>
     */
    public function getWorkbook(string $workbookId): array
    {
        return $this->request('GET', "/sites/{$this->siteId}/workbooks/{$workbookId}");
    }

    /**
     * List views on the configured site.
     *
     * @param  int  $pageSize  Number of views per page (max 1000).
     * @param  int  $pageNumber  Page number (1-based).
     * @return array<string, mixed>
     */
    public function listViews(int $pageSize = 100, int $pageNumber = 1): array
    {
        return $this->request('GET', "/sites/{$this->siteId}/views", [
            'pageSize' => $pageSize,
            'pageNumber' => $pageNumber,
        ]);
    }

    /**
     * Get a single view by ID.
     *
     * @param  string  $viewId  The view LUID.
     * @return array<string, mixed>
     */
    public function getView(string $viewId): array
    {
        return $this->request('GET', "/sites/{$this->siteId}/views/{$viewId}");
    }

    /**
     * List projects on the configured site.
     *
     * @param  int  $pageSize  Number of projects per page (max 1000).
     * @param  int  $pageNumber  Page number (1-based).
     * @return array<string, mixed>
     */
    public function listProjects(int $pageSize = 100, int $pageNumber = 1): array
    {
        return $this->request('GET', "/sites/{$this->siteId}/projects", [
            'pageSize' => $pageSize,
            'pageNumber' => $pageNumber,
        ]);
    }

    /**
     * Get the currently authenticated user's information.
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
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/sites/{siteId}/workbooks").
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $query);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Tableau REST API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $query  Query parameters for GET requests.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $query = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Tableau access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Tableau-Auth' => $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($url, $query),
                'PUT' => $http->put($url, $query),
                'DELETE' => $http->delete($url, $query),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error.message') ?? $response->body();

                Log::error("Tableau API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Tableau API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Tableau API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Tableau API: {$e->getMessage()}");
        }
    }
}
