<?php

namespace OpenCompany\Integrations\Zapier;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Zapier REST API.
 *
 * Wraps HTTP calls to Zapier's REST endpoints for zaps, executions,
 * connections, and the current user profile.
 *
 * Authentication uses a Bearer token sent in the Authorization header.
 * The base URL is https://zapier.com/api/v1.
 */
class ZapierService
{
    private const BASE_URL = 'https://zapier.com/api/v1';

    /**
     * @param  string  $accessToken  Zapier API token (Bearer)
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Connection ──────────────────────────────────────────

    /**
     * Test the connection by fetching the current user profile.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/me');
    }

    // ── Zaps ────────────────────────────────────────────────

    /**
     * List zaps with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (limit, page)
     * @return array<string, mixed>
     */
    public function listZaps(array $params = []): array
    {
        return $this->request('GET', '/zaps', $params);
    }

    /**
     * Get a zap by ID.
     *
     * @param  string  $id  Zap ID
     * @return array<string, mixed>
     */
    public function getZap(string $id): array
    {
        return $this->request('GET', "/zaps/{$id}");
    }

    // ── Executions ──────────────────────────────────────────

    /**
     * List executions with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (zap_id, limit, page)
     * @return array<string, mixed>
     */
    public function listExecutions(array $params = []): array
    {
        return $this->request('GET', '/executions', $params);
    }

    /**
     * Get an execution by ID.
     *
     * @param  string  $id  Execution ID
     * @return array<string, mixed>
     */
    public function getExecution(string $id): array
    {
        return $this->request('GET', "/executions/{$id}");
    }

    // ── Connections ─────────────────────────────────────────

    /**
     * List connections with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (limit, page)
     * @return array<string, mixed>
     */
    public function listConnections(array $params = []): array
    {
        return $this->request('GET', '/connections', $params);
    }

    /**
     * Get a connection by ID.
     *
     * @param  string  $id  Connection ID
     * @return array<string, mixed>
     */
    public function getConnection(string $id): array
    {
        return $this->request('GET', "/connections/{$id}");
    }

    // ── User ────────────────────────────────────────────────

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Zapier.
     *
     * Sends the Bearer token in the Authorization header.
     * For GET requests the params are sent as query parameters.
     *
     * @param  string                 $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string                 $path    API path (e.g. /zaps)
     * @param  array<string, mixed>   $data    Query or body params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Zapier access token is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Zapier API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("Zapier API error ({$response->status()}): {$response->body()}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zapier API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zapier API: {$e->getMessage()}");
        }
    }
}
