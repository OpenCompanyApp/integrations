<?php

namespace OpenCompany\Integrations\MakeCom;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Make.com REST API.
 *
 * Wraps HTTP calls to Make.com's REST endpoints for scenarios, executions,
 * connections, teams, and user profile.
 *
 * Authentication uses an API token sent as a Bearer header.
 * Base URL: https://api.make.com/v1
 */
class MakeComService
{
    private const BASE_URL = 'https://api.make.com/v1';

    /**
     * @param  string  $apiToken  Make.com API token
     */
    public function __construct(
        private string $apiToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    // ── Connection ──────────────────────────────────────────

    /**
     * Test the connection by fetching the current user profile.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Scenarios ───────────────────────────────────────────

    /**
     * List scenarios with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (organizationId, teamId, folderId, limit, offset)
     * @return array<string, mixed>
     */
    public function listScenarios(array $params = []): array
    {
        return $this->request('GET', '/scenarios', $params);
    }

    /**
     * Get a single scenario by ID.
     *
     * @param  string  $id  Scenario ID
     * @return array<string, mixed>
     */
    public function getScenario(string $id): array
    {
        return $this->request('GET', "/scenarios/{$id}");
    }

    // ── Executions ──────────────────────────────────────────

    /**
     * List executions with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (scenarioId, status, limit, offset)
     * @return array<string, mixed>
     */
    public function listExecutions(array $params = []): array
    {
        return $this->request('GET', '/scenarios/runs', $params);
    }

    /**
     * Get a single execution by ID.
     *
     * @param  string  $id  Execution (run) ID
     * @return array<string, mixed>
     */
    public function getExecution(string $id): array
    {
        return $this->request('GET', "/scenarios/runs/{$id}");
    }

    // ── Connections ─────────────────────────────────────────

    /**
     * List connections with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (teamId, limit, offset)
     * @return array<string, mixed>
     */
    public function listConnections(array $params = []): array
    {
        return $this->request('GET', '/connections', $params);
    }

    // ── Teams ───────────────────────────────────────────────

    /**
     * List teams (organizations) the authenticated user has access to.
     *
     * @param  array<string, mixed>  $params  Query params (limit, offset)
     * @return array<string, mixed>
     */
    public function listTeams(array $params = []): array
    {
        return $this->request('GET', '/teams', $params);
    }

    // ── Users ───────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Make.com.
     *
     * Sends the Bearer token in the Authorization header. For GET requests
     * the params are sent as query parameters.
     *
     * @param  string                 $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string                 $path    API path (e.g. /scenarios)
     * @param  array<string, mixed>   $params  Query or body params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Make.com API token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $params),
                'POST'   => $http->post($url, $params),
                'PUT'    => $http->put($url, $params),
                'DELETE' => $http->delete($url),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Make.com API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("Make.com API error ({$response->status()}): {$response->body()}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Make.com API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Make.com API: {$e->getMessage()}");
        }
    }
}
