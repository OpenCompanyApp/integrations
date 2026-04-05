<?php

namespace OpenCompany\Integrations\PagerDuty;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * PagerDuty REST API service for making authenticated requests.
 *
 * Handles authentication via API token and provides methods for all
 * PagerDuty v2 REST API endpoints used by the integration tools.
 *
 * @see https://developer.pagerduty.com/api-reference/
 */
class PagerDutyService
{
    /**
     * PagerDuty REST API v2 base URL.
     */
    private const BASE_URL = 'https://api.pagerduty.com';

    /**
     * @param  string  $apiToken  PagerDuty API token (generated in Developer → API Access Keys)
     */
    public function __construct(
        private string $apiToken = '',
    ) {}

    /**
     * Check whether the service has been configured with an API token.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── Incidents ──────────────────────────────────────────

    /**
     * List incidents with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, offset, status[], service_ids[], urgency, etc.)
     * @return array<string, mixed>  PagerDuty API response with incidents, total, and pagination info
     *
     * @see https://developer.pagerduty.com/api-reference/list-incidents
     */
    public function listIncidents(array $params = []): array
    {
        return $this->request('GET', '/incidents', $params);
    }

    /**
     * Retrieve a single incident by ID.
     *
     * @param  string  $id  PagerDuty incident ID (e.g., "Q02JFSRXI65D55")
     * @return array<string, mixed>  PagerDuty incident object
     *
     * @see https://developer.pagerduty.com/api-reference/get-an-incident
     */
    public function getIncident(string $id): array
    {
        return $this->request('GET', "/incidents/{$id}");
    }

    /**
     * Update an incident's status, priority, or other fields.
     *
     * @param  string  $id     PagerDuty incident ID
     * @param  array<string, mixed>  $data  Incident fields to update (status, priority, etc.)
     * @return array<string, mixed>  Updated incident object
     *
     * @see https://developer.pagerduty.com/api-reference/update-an-incident
     */
    public function updateIncident(string $id, array $data): array
    {
        $payload = [
            'incident' => $data,
        ];

        return $this->request('PUT', "/incidents/{$id}", body: $payload);
    }

    /**
     * Create a note on an incident.
     *
     * @param  string  $id       PagerDuty incident ID
     * @param  string  $content  The note content
     * @return array<string, mixed>  Created note object
     *
     * @see https://developer.pagerduty.com/api-reference/create-a-note-on-an-incident
     */
    public function createIncidentNote(string $id, string $content): array
    {
        $payload = [
            'note' => [
                'content' => $content,
            ],
        ];

        return $this->request('POST', "/incidents/{$id}/notes", body: $payload);
    }

    // ── Services ───────────────────────────────────────────

    /**
     * List services with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, offset, team_ids[], etc.)
     * @return array<string, mixed>  PagerDuty API response with services, total, and pagination info
     *
     * @see https://developer.pagerduty.com/api-reference/list-services
     */
    public function listServices(array $params = []): array
    {
        return $this->request('GET', '/services', $params);
    }

    /**
     * Retrieve a single service by ID.
     *
     * @param  string  $id  PagerDuty service ID (e.g., "PIJ90N7")
     * @return array<string, mixed>  PagerDuty service object
     *
     * @see https://developer.pagerduty.com/api-reference/get-a-service
     */
    public function getService(string $id): array
    {
        return $this->request('GET', "/services/{$id}");
    }

    // ── Teams ──────────────────────────────────────────────

    /**
     * List teams with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, offset, etc.)
     * @return array<string, mixed>  PagerDuty API response with teams, total, and pagination info
     *
     * @see https://developer.pagerduty.com/api-reference/list-teams
     */
    public function listTeams(array $params = []): array
    {
        return $this->request('GET', '/teams', $params);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * List users with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, offset, team_ids[], etc.)
     * @return array<string, mixed>  PagerDuty API response with users, total, and pagination info
     *
     * @see https://developer.pagerduty.com/api-reference/list-users
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Retrieve a single user by ID.
     *
     * @param  string  $id  PagerDuty user ID (e.g., "PXPGF42")
     * @return array<string, mixed>  PagerDuty user object
     *
     * @see https://developer.pagerduty.com/api-reference/get-a-user
     */
    public function getUser(string $id): array
    {
        return $this->request('GET', "/users/{$id}");
    }

    // ── On-Call ────────────────────────────────────────────

    /**
     * List current on-call entries with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, escalation_policy_ids[], etc.)
     * @return array<string, mixed>  PagerDuty API response with oncalls, total, and pagination info
     *
     * @see https://developer.pagerduty.com/api-reference/list-all-on-calls
     */
    public function listOnCalls(array $params = []): array
    {
        return $this->request('GET', '/oncalls', $params);
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Execute an authenticated HTTP request to the PagerDuty REST API.
     *
     * Sends the API token via the `Authorization: Token token={token}` header
     * and expects JSON request/response bodies.
     *
     * @param  string  $method   HTTP method (GET, POST, PUT)
     * @param  string  $path     API endpoint path (e.g., "/incidents")
     * @param  array<string, mixed>  $query   Query parameters for GET requests
     * @param  array<string, mixed>|null  $body   JSON body for POST/PUT requests
     * @return array<string, mixed>  Decoded JSON response body
     *
     * @throws \RuntimeException  On connection failure or API error
     */
    private function request(string $method, string $path, array $query = [], ?array $body = null): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('PagerDuty API token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Token token=' . $this->apiToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get(self::BASE_URL . $path, $query),
                'POST' => $http->post(self::BASE_URL . $path, $body ?? []),
                'PUT' => $http->put(self::BASE_URL . $path, $body ?? []),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $json = $response->json() ?? [];

            if (! $response->successful()) {
                $error = $json['error']['message'] ?? $response->body();
                $code = $json['error']['code'] ?? '';

                Log::error("PagerDuty API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                    'code' => $code,
                ]);

                $msg = is_string($error) ? $error : json_encode($error);
                if ($code) {
                    $msg .= " (code: {$code})";
                }

                throw new \RuntimeException('PagerDuty API error (' . $response->status() . '): ' . $msg);
            }

            return $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("PagerDuty API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to PagerDuty API: {$e->getMessage()}");
        }
    }
}
