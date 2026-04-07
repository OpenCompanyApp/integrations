<?php

namespace OpenCompany\Integrations\Prometheus;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Prometheus API service for communicating with a Prometheus instance.
 *
 * Handles authentication via Bearer tokens and provides methods for
 * alerts, rules, targets, and user info.
 */
class PrometheusService
{
    /**
     * Create a new PrometheusService instance.
     *
     * @param string $apiToken The Prometheus API bearer token.
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
     * Get the configured base URL for the Prometheus API.
     */
    public function getBaseUrl(): string
    {
        return 'https://api.prometheus.io/v1';
    }

    /**
     * List all alerts.
     *
     * @param array<string, mixed> $filters Optional filters (e.g., filter, receiver).
     * @return array<string, mixed>
     */
    public function listAlerts(array $filters = []): array
    {
        return $this->request('GET', '/alerts', $filters);
    }

    /**
     * Get a specific alert by its name.
     *
     * @param string $name The alert name.
     * @return array<string, mixed>
     */
    public function getAlert(string $name): array
    {
        return $this->request('GET', '/alerts/' . urlencode($name));
    }

    /**
     * List all alerting and recording rules.
     *
     * @param string|null $type Optional type filter (e.g., "alert" or "recording").
     * @return array<string, mixed>
     */
    public function listRules(?string $type = null): array
    {
        $params = [];
        if ($type !== null) {
            $params['type'] = $type;
        }

        return $this->request('GET', '/rules', $params);
    }

    /**
     * Get a specific rule group by name.
     *
     * @param string $name The rule group name.
     * @return array<string, mixed>
     */
    public function getRule(string $name): array
    {
        return $this->request('GET', '/rules/' . urlencode($name));
    }

    /**
     * List all scrape targets.
     *
     * @param string|null $state Optional state filter (e.g., "active", "dropped").
     * @return array<string, mixed>
     */
    public function listTargets(?string $state = null): array
    {
        $params = [];
        if ($state !== null) {
            $params['state'] = $state;
        }

        return $this->request('GET', '/targets', $params);
    }

    /**
     * Get a specific target by its instance address.
     *
     * @param string $instance The target instance address.
     * @return array<string, mixed>
     */
    public function getTarget(string $instance): array
    {
        return $this->request('GET', '/targets/' . urlencode($instance));
    }

    /**
     * Get the current authenticated user info.
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
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Prometheus API.
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
            throw new \RuntimeException('Prometheus API token is not configured.');
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
                    Log::warning("Prometheus API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Prometheus API endpoint not available (HTTP {$response->status()}). Check your API path.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Prometheus API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Prometheus API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Prometheus API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Prometheus API: {$e->getMessage()}");
        }
    }
}
