<?php

namespace OpenCompany\Integrations\Pagerduty;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * PagerDuty API service.
 *
 * Handles HTTP communication with the PagerDuty REST API using Bearer token
 * authentication. Provides methods for incidents, services, teams, and user
 * management.
 *
 * @see https://developer.pagerduty.com/api-reference/
 */
class PagerdutyService
{
    /**
     * Create a new PagerdutyService instance.
     *
     * @param  string  $apiToken  PagerDuty API token (Bearer token).
     * @param  string  $baseUrl   Base URL for the PagerDuty API (defaults to https://api.pagerduty.com).
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.pagerduty.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API token.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ─── Incidents ────────────────────────────────────────────────────────

    /**
     * List incidents with optional filtering and pagination.
     *
     * @param  string|null  $status  Filter by status (triggered, acknowledged, resolved).
     * @param  string|null  $urgency  Filter by urgency (high, low).
     * @param  string|null  $serviceId  Filter by service ID.
     * @param  string|null  $teamId  Filter by team ID.
     * @param  int  $limit  Maximum number of incidents to return (default 25, max 100).
     * @param  int  $offset  Offset for pagination.
     * @return array<string, mixed> API response containing incidents and pagination info.
     *
     * @see https://developer.pagerduty.com/api-reference/list-incidents
     */
    public function listIncidents(
        ?string $status = null,
        ?string $urgency = null,
        ?string $serviceId = null,
        ?string $teamId = null,
        int $limit = 25,
        int $offset = 0,
    ): array {
        $params = ['limit' => min($limit, 100), 'offset' => $offset];
        if ($status !== null) {
            $params['statuses[]'] = $status;
        }
        if ($urgency !== null) {
            $params['urgencies[]'] = $urgency;
        }
        if ($serviceId !== null) {
            $params['service_ids[]'] = $serviceId;
        }
        if ($teamId !== null) {
            $params['team_ids[]'] = $teamId;
        }

        return $this->request('GET', '/incidents', $params);
    }

    /**
     * Get a single incident by ID.
     *
     * @param  string  $id  The incident ID.
     * @return array<string, mixed> The incident data.
     *
     * @see https://developer.pagerduty.com/api-reference/get-an-incident
     */
    public function getIncident(string $id): array
    {
        return $this->request('GET', '/incidents/' . urlencode($id));
    }

    // ─── Services ─────────────────────────────────────────────────────────

    /**
     * List services with optional filtering and pagination.
     *
     * @param  string|null  $teamId  Filter by team ID.
     * @param  int  $limit  Maximum number of services to return (default 25, max 100).
     * @param  int  $offset  Offset for pagination.
     * @return array<string, mixed> API response containing services and pagination info.
     *
     * @see https://developer.pagerduty.com/api-reference/list-services
     */
    public function listServices(?string $teamId = null, int $limit = 25, int $offset = 0): array
    {
        $params = ['limit' => min($limit, 100), 'offset' => $offset];
        if ($teamId !== null) {
            $params['team_ids[]'] = $teamId;
        }

        return $this->request('GET', '/services', $params);
    }

    /**
     * Get a single service by ID.
     *
     * @param  string  $id  The service ID.
     * @return array<string, mixed> The service data.
     *
     * @see https://developer.pagerduty.com/api-reference/get-a-service
     */
    public function getService(string $id): array
    {
        return $this->request('GET', '/services/' . urlencode($id));
    }

    // ─── Teams ────────────────────────────────────────────────────────────

    /**
     * List teams with optional pagination.
     *
     * @param  int  $limit  Maximum number of teams to return (default 25, max 100).
     * @param  int  $offset  Offset for pagination.
     * @return array<string, mixed> API response containing teams and pagination info.
     *
     * @see https://developer.pagerduty.com/api-reference/list-teams
     */
    public function listTeams(int $limit = 25, int $offset = 0): array
    {
        $params = ['limit' => min($limit, 100), 'offset' => $offset];

        return $this->request('GET', '/teams', $params);
    }

    /**
     * Get a single team by ID.
     *
     * @param  string  $id  The team ID.
     * @return array<string, mixed> The team data.
     *
     * @see https://developer.pagerduty.com/api-reference/get-a-team
     */
    public function getTeam(string $id): array
    {
        return $this->request('GET', '/teams/' . urlencode($id));
    }

    // ─── User ─────────────────────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The user profile data.
     *
     * @see https://developer.pagerduty.com/api-reference/get-the-current-user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ─── Internal helpers ─────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g. "/incidents").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> Parsed JSON response.
     *
     * @throws \RuntimeException On API errors or connection failures.
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
     * Make a raw HTTP request to the PagerDuty API using Bearer token auth.
     *
     * Includes the required Accept header for the PagerDuty REST API v2.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PUT/DELETE).
     * @return Response The raw HTTP response.
     *
     * @throws \RuntimeException On API errors, connection failures, or missing API token.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('PagerDuty API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Accept' => 'application/vnd.pagerduty+json;version=2',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("PagerDuty API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("PagerDuty API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("PagerDuty API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException("PagerDuty API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("PagerDuty API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to PagerDuty API: {$e->getMessage()}");
        }
    }
}
