<?php

namespace OpenCompany\Integrations\Ifttt;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the IFTTT REST API.
 *
 * Wraps HTTP calls to IFTTT's REST endpoints for services, applets,
 * connections, and the current user profile.
 *
 * Authentication uses a Bearer token sent in the Authorization header.
 * The base URL is https://api.ifttt.com/v1.
 */
class IftttService
{
    private const BASE_URL = 'https://api.ifttt.com/v1';

    /**
     * @param  string  $accessToken  IFTTT API token (Bearer)
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Services ───────────────────────────────────────────

    /**
     * List services with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (limit, page)
     * @return array<string, mixed>
     */
    public function listServices(array $params = []): array
    {
        return $this->request('GET', '/services', $params);
    }

    /**
     * Get a service by ID.
     *
     * @param  string  $id  Service ID
     * @return array<string, mixed>
     */
    public function getService(string $id): array
    {
        return $this->request('GET', "/services/{$id}");
    }

    // ── Applets ────────────────────────────────────────────

    /**
     * List applets with optional filters.
     *
     * @param  array<string, mixed>  $params  Query params (limit, page)
     * @return array<string, mixed>
     */
    public function listApplets(array $params = []): array
    {
        return $this->request('GET', '/applets', $params);
    }

    /**
     * Get an applet by ID.
     *
     * @param  string  $id  Applet ID
     * @return array<string, mixed>
     */
    public function getApplet(string $id): array
    {
        return $this->request('GET', "/applets/{$id}");
    }

    // ── Connections ────────────────────────────────────────

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

    // ── User ───────────────────────────────────────────────

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    // ── HTTP ────────────────────────────────────────────────

    /**
     * Make an API request to IFTTT.
     *
     * Sends the Bearer token in the Authorization header.
     * For GET requests the params are sent as query parameters.
     *
     * @param  string                 $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string                 $path    API path (e.g. /services)
     * @param  array<string, mixed>   $data    Query or body params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('IFTTT access token is not configured.');
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
                Log::error("IFTTT API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("IFTTT API error ({$response->status()}): {$response->body()}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("IFTTT API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to IFTTT API: {$e->getMessage()}");
        }
    }
}
