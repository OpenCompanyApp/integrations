<?php

namespace OpenCompany\Integrations\MicrosoftPowerBI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PowerBIService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.powerbi.com/v1.0/myorg',
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
     * List all reports the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listReports(): array
    {
        return $this->request('GET', '/reports');
    }

    /**
     * Get a specific report by its ID.
     *
     * @return array<string, mixed>
     */
    public function getReport(string $reportId): array
    {
        return $this->request('GET', '/reports/' . urlencode($reportId));
    }

    /**
     * List all datasets the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listDatasets(): array
    {
        return $this->request('GET', '/datasets');
    }

    /**
     * Get a specific dataset by its ID.
     *
     * @return array<string, mixed>
     */
    public function getDataset(string $datasetId): array
    {
        return $this->request('GET', '/datasets/' . urlencode($datasetId));
    }

    /**
     * List all workspaces (groups) the authenticated user has access to.
     *
     * @return array<string, mixed>
     */
    public function listWorkspaces(): array
    {
        return $this->request('GET', '/groups');
    }

    /**
     * Get the current authenticated user's profile.
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
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Power BI REST API.
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Power BI API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Power BI API endpoint not available (HTTP {$response->status()}). The access token may be expired or the URL may be incorrect.");
                }

                $error = $response->json('error.message') ?? $response->json('error') ?? $body;
                Log::error("Power BI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Power BI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
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
