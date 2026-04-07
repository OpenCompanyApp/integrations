<?php

namespace OpenCompany\Integrations\Speedcurve;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SpeedcurveService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.speedcurve.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the current user associated with the API key.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * List all sites.
     */
    public function listSites(): array
    {
        return $this->request('GET', '/sites');
    }

    /**
     * Get a specific site by ID.
     */
    public function getSite(int $siteId): array
    {
        return $this->request('GET', '/sites/' . $siteId);
    }

    /**
     * List recent tests, optionally filtered by site or URL.
     */
    public function listTests(array $params = []): array
    {
        return $this->request('GET', '/tests', $params);
    }

    /**
     * Get details for a specific test by ID.
     */
    public function getTest(int $testId): array
    {
        return $this->request('GET', '/tests/' . $testId);
    }

    /**
     * List deployments, optionally filtered.
     */
    public function listDeployments(array $params = []): array
    {
        return $this->request('GET', '/deployments', $params);
    }

    /**
     * Create a new deployment.
     */
    public function createDeployment(array $data): array
    {
        return $this->request('POST', '/deployments', $data);
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
     * Make a raw HTTP request to the SpeedCurve API.
     * Uses HTTP Basic Auth with the API key as username and blank password.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('SpeedCurve API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, '')
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->timeout(30);

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
                    Log::warning("SpeedCurve API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("SpeedCurve API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("SpeedCurve API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("SpeedCurve API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("SpeedCurve API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to SpeedCurve API: {$e->getMessage()}");
        }
    }
}
