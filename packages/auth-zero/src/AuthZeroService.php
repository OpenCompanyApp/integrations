<?php

namespace OpenCompany\Integrations\AuthZero;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Auth0 Management API v2.
 *
 * Communicates with {@link https://auth0.com/docs/api/management/v2} using
 * Bearer-token authentication. The base URL is derived from the configured
 * tenant domain (e.g. <code>tenant.us.auth0.com</code>).
 */
class AuthZeroService
{
    private string $baseUrl;

    public function __construct(
        private string $accessToken = '',
        private string $domain = '',
    ) {
        $this->domain = rtrim($this->domain, '/');
        $this->baseUrl = $this->domain !== ''
            ? 'https://' . $this->domain . '/api/v2'
            : '';
    }

    /**
     * Determine whether the service has enough configuration to make requests.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->domain);
    }

    /**
     * List users in the tenant.
     *
     * @param array $params Query parameters (page, per_page, q, sort, etc.)
     * @return array Decoded JSON response
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/get_users
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Retrieve a single user by their Auth0 user ID.
     *
     * @param string $id The Auth0 user identifier (e.g. "auth0|abc123")
     * @return array Decoded JSON response
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/get_users_by_id
     */
    public function getUser(string $id): array
    {
        return $this->request('GET', '/users/' . urlencode($id));
    }

    /**
     * Create a new user in the specified connection.
     *
     * @param array $data User payload (email, password, connection, name, etc.)
     * @return array Decoded JSON response
     *
     * @see https://auth0.com/docs/api/management/v2#!/Users/post_users
     */
    public function createUser(array $data): array
    {
        return $this->request('POST', '/users', $data);
    }

    /**
     * List connections configured in the tenant.
     *
     * @param array $params Query parameters (strategy, etc.)
     * @return array Decoded JSON response
     *
     * @see https://auth0.com/docs/api/management/v2#!/Connections/get_connections
     */
    public function listConnections(array $params = []): array
    {
        return $this->request('GET', '/connections', $params);
    }

    /**
     * List roles defined in the tenant.
     *
     * @param array $params Query parameters (page, per_page, etc.)
     * @return array Decoded JSON response
     *
     * @see https://auth0.com/docs/api/management/v2#!/Roles/get_roles
     */
    public function getRoles(array $params = []): array
    {
        return $this->request('GET', '/roles', $params);
    }

    /**
     * Retrieve the tenant settings.
     *
     * @return array Decoded JSON response
     *
     * @see https://auth0.com/docs/api/management/v2#!/Tenants/get_settings
     */
    public function getTenantSettings(): array
    {
        return $this->request('GET', '/tenants/settings');
    }

    /**
     * Send an HTTP request to the Auth0 Management API and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE, PATCH)
     * @param string $path   API path (e.g. "/users")
     * @param array  $data   Query parameters (GET) or JSON body (POST/PUT/PATCH)
     * @return array Decoded JSON response, or empty array on 204 No Content
     *
     * @throws \RuntimeException When the service is not configured or the API returns an error
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
     * Execute a raw HTTP request against the Auth0 Management API.
     *
     * @param string $method HTTP method
     * @param string $path   API path
     * @param array  $data   Query params or JSON body
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On configuration, connection, or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Auth0 integration is not configured. Provide an access_token and domain.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();
                Log::error("Auth0 API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException(
                    "Auth0 API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Auth0 API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Auth0 API: {$e->getMessage()}");
        }
    }
}
