<?php

namespace OpenCompany\Integrations\Pingdom;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PingdomService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.pingdom.com/api/3.1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all uptime checks.
     */
    public function listChecks(array $params = []): array
    {
        return $this->request('GET', '/checks', $params);
    }

    /**
     * Get details for a specific check.
     */
    public function getCheck(int $checkId): array
    {
        return $this->request('GET', '/checks/' . $checkId);
    }

    /**
     * Create a new uptime check.
     */
    public function createCheck(array $data): array
    {
        return $this->request('POST', '/checks', $data);
    }

    /**
     * List results (summary) for a specific check.
     */
    public function listResults(int $checkId, array $params = []): array
    {
        return $this->request('GET', '/results/' . $checkId, $params);
    }

    /**
     * Get detailed results for a specific check.
     */
    public function getResults(int $checkId, array $params = []): array
    {
        return $this->request('GET', '/results/' . $checkId, $params);
    }

    /**
     * List alerts for the current account.
     */
    public function listAlerts(array $params = []): array
    {
        return $this->request('GET', '/alerts', $params);
    }

    /**
     * Get the current authenticated user.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/current');
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Pingdom API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Pingdom API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                    Log::warning("Pingdom API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Pingdom API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Pingdom API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Pingdom API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Pingdom API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Pingdom API: {$e->getMessage()}");
        }
    }
}
