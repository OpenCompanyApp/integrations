<?php

namespace OpenCompany\Integrations\Datadog;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Datadog API service for communicating with the Datadog v1 REST API.
 *
 * Handles authentication via DD-API-KEY and DD-APPLICATION-KEY headers,
 * and provides methods for monitors, metrics, dashboards, and events.
 */
class DatadogService
{
    /**
     * Create a new DatadogService instance.
     *
     * @param  string  $apiKey  Datadog API key
     * @param  string  $appKey  Datadog Application key
     * @param  string  $site  Datadog site identifier: "us" or "eu"
     */
    public function __construct(
        private string $apiKey = '',
        private string $appKey = '',
        private string $site = 'us',
    ) {}

    /**
     * Check whether the service has the required credentials configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->appKey);
    }

    /**
     * Get the base API URL for the configured Datadog site.
     *
     * @return string The base URL (e.g., "https://api.datadoghq.com/api/v1")
     */
    public function getBaseUrl(): string
    {
        return match ($this->site) {
            'eu' => 'https://api.datadoghq.eu/api/v1',
            default => 'https://api.datadoghq.com/api/v1',
        };
    }

    /**
     * List monitors with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (name, tags, page, etc.)
     * @return array<string, mixed>
     */
    public function listMonitors(array $params = []): array
    {
        return $this->request('GET', '/monitor', $params);
    }

    /**
     * Get a single monitor by ID.
     *
     * @param  int  $monitorId  The monitor ID
     * @return array<string, mixed>
     */
    public function getMonitor(int $monitorId): array
    {
        return $this->request('GET', '/monitor/' . $monitorId);
    }

    /**
     * Create a new monitor.
     *
     * @param  array<string, mixed>  $body  Monitor definition (type, query, name, message, options)
     * @return array<string, mixed>
     */
    public function createMonitor(array $body): array
    {
        return $this->request('POST', '/monitor', $body);
    }

    /**
     * Update an existing monitor.
     *
     * @param  int  $monitorId  The monitor ID
     * @param  array<string, mixed>  $body  Updated monitor definition
     * @return array<string, mixed>
     */
    public function updateMonitor(int $monitorId, array $body): array
    {
        return $this->request('PUT', '/monitor/' . $monitorId, $body);
    }

    /**
     * Delete a monitor.
     *
     * @param  int  $monitorId  The monitor ID
     * @return array<string, mixed>
     */
    public function deleteMonitor(int $monitorId): array
    {
        return $this->request('DELETE', '/monitor/' . $monitorId);
    }

    /**
     * Query metrics from the Datadog API.
     *
     * @param  int  $from  Start timestamp (Unix epoch seconds)
     * @param  int  $to  End timestamp (Unix epoch seconds)
     * @param  string  $query  Datadog metric query string
     * @return array<string, mixed>
     */
    public function queryMetrics(int $from, int $to, string $query): array
    {
        return $this->request('GET', '/query', [
            'from' => $from,
            'to' => $to,
            'query' => $query,
        ]);
    }

    /**
     * List all dashboards.
     *
     * @return array<string, mixed>
     */
    public function listDashboards(): array
    {
        return $this->request('GET', '/dashboard');
    }

    /**
     * Get a single dashboard by ID.
     *
     * @param  string  $dashboardId  The dashboard ID
     * @return array<string, mixed>
     */
    public function getDashboard(string $dashboardId): array
    {
        return $this->request('GET', '/dashboard/' . $dashboardId);
    }

    /**
     * Post an event to the Datadog event stream.
     *
     * @param  array<string, mixed>  $body  Event payload (title, text, priority, tags, alert_type)
     * @return array<string, mixed>
     */
    public function postEvent(array $body): array
    {
        return $this->request('POST', '/events', $body);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Validate the API key by calling the /validate endpoint.
     *
     * @return array{valid: bool}
     */
    public function validateApiKey(): array
    {
        return $this->request('GET', '/validate');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path (e.g., "/monitor")
     * @param  array<string, mixed>  $data  Query params (GET) or body data (POST/PUT)
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
     * Make a raw HTTP request to the Datadog API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $data  Request data
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On missing credentials, connection errors, or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Datadog API key is not configured.');
        }

        if (!$this->appKey) {
            throw new \RuntimeException('Datadog Application key is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'DD-API-KEY' => $this->apiKey,
                'DD-APPLICATION-KEY' => $this->appKey,
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
                $error = $response->json('errors') ?? $response->body();

                if (is_array($error)) {
                    $error = implode(', ', $error);
                }

                Log::error("Datadog API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Datadog API error ({$response->status()}): {$error}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Datadog API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Datadog API: {$e->getMessage()}");
        }
    }
}
