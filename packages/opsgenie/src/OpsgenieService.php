<?php

namespace OpenCompany\Integrations\Opsgenie;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Opsgenie API service for communicating with the Opsgenie v2 REST API.
 *
 * Handles authentication via Bearer token and provides methods for
 * alerts, incidents, teams, and user management.
 */
class OpsgenieService
{
    /**
     * Create a new OpsgenieService instance.
     *
     * @param  string  $apiKey  Opsgenie API key (used as Bearer token)
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the service has the required credentials configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the base API URL.
     *
     * @return string The base URL (https://api.opsgenie.com/v2)
     */
    public function getBaseUrl(): string
    {
        return 'https://api.opsgenie.com/v2';
    }

    /**
     * List alerts with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (query, limit, offset, sort, order, etc.)
     * @return array<string, mixed>
     */
    public function listAlerts(array $params = []): array
    {
        return $this->request('GET', '/alerts', $params);
    }

    /**
     * Get a single alert by ID.
     *
     * @param  string  $alertId  The alert identifier
     * @return array<string, mixed>
     */
    public function getAlert(string $alertId): array
    {
        return $this->request('GET', '/alerts/' . $alertId);
    }

    /**
     * Create a new alert.
     *
     * @param  array<string, mixed>  $body  Alert payload (message, alias, description, priority, etc.)
     * @return array<string, mixed>
     */
    public function createAlert(array $body): array
    {
        return $this->request('POST', '/alerts', $body);
    }

    /**
     * List incidents with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (query, limit, offset, sort, order, etc.)
     * @return array<string, mixed>
     */
    public function listIncidents(array $params = []): array
    {
        return $this->request('GET', '/incidents', $params);
    }

    /**
     * Get a single incident by ID.
     *
     * @param  string  $incidentId  The incident identifier
     * @return array<string, mixed>
     */
    public function getIncident(string $incidentId): array
    {
        return $this->request('GET', '/incidents/' . $incidentId);
    }

    /**
     * List all teams.
     *
     * @return array<string, mixed>
     */
    public function listTeams(): array
    {
        return $this->request('GET', '/teams');
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
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API path (e.g., "/alerts")
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
     * Make a raw HTTP request to the Opsgenie API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path    API path
     * @param  array<string, mixed>  $data  Request data
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On missing credentials, connection errors, or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Opsgenie API key is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'GenieKey ' . $this->apiKey,
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
                $error = $response->json('message') ?? $response->body();

                if (is_array($error)) {
                    $error = implode(', ', $error);
                }

                Log::error("Opsgenie API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Opsgenie API error ({$response->status()}): {$error}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Opsgenie API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Opsgenie API: {$e->getMessage()}");
        }
    }
}
