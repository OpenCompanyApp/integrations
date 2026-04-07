<?php

namespace OpenCompany\Integrations\Radar;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Radar API service for making authenticated requests to the Radar REST API.
 *
 * Handles HTTP communication with the Radar API including authentication via
 * Bearer tokens, request/response processing, and error handling.
 *
 * @see https://radar.com/documentation/api
 */
class RadarService
{
    /**
     * Create a new RadarService instance.
     *
     * @param  string  $accessToken  The API key for Radar authentication.
     * @param  string  $baseUrl  The base URL for the Radar API (default: https://api.radar.io/v1).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.radar.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Radar integration is properly configured.
     *
     * Returns true when a non-empty access token has been provided.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    // --------------------------------------------------------------------------
    // Geofences
    // --------------------------------------------------------------------------

    /**
     * List geofences with optional filters and pagination.
     *
     * @param  array  $filters  Query parameters such as `limit`, `cursor`, `tag`, `group`, etc.
     * @return array<string, mixed> The parsed JSON response containing geofences data.
     *
     * @see https://radar.com/documentation/api/#list-geofences
     */
    public function listGeofences(array $filters = []): array
    {
        return $this->request('GET', '/geofences', $filters);
    }

    /**
     * Retrieve a single geofence by its ID.
     *
     * @param  string  $geofenceId  The unique identifier of the geofence.
     * @return array<string, mixed> The parsed JSON response containing the geofence data.
     *
     * @see https://radar.com/documentation/api/#get-geofence
     */
    public function getGeofence(string $geofenceId): array
    {
        return $this->request('GET', '/geofences/' . $geofenceId);
    }

    /**
     * Create a new geofence in Radar.
     *
     * @param  array  $data  Geofence fields: `name`, `description`, `type`, `coordinates`, `radius`, `tag`, `group`, etc.
     * @return array<string, mixed> The parsed JSON response containing the created geofence.
     *
     * @see https://radar.com/documentation/api/#create-geofence
     */
    public function createGeofence(array $data): array
    {
        return $this->request('POST', '/geofences', $data);
    }

    // --------------------------------------------------------------------------
    // Users
    // --------------------------------------------------------------------------

    /**
     * List users with optional filters and pagination.
     *
     * @param  array  $filters  Query parameters such as `limit`, `cursor`, `tags`, etc.
     * @return array<string, mixed> The parsed JSON response containing users data.
     *
     * @see https://radar.com/documentation/api/#list-users
     */
    public function listUsers(array $filters = []): array
    {
        return $this->request('GET', '/users', $filters);
    }

    /**
     * Retrieve a single user by their ID.
     *
     * @param  string  $userId  The unique identifier of the user.
     * @return array<string, mixed> The parsed JSON response containing the user data.
     *
     * @see https://radar.com/documentation/api/#get-user
     */
    public function getUser(string $userId): array
    {
        return $this->request('GET', '/users/' . $userId);
    }

    /**
     * Get the currently authenticated user context.
     *
     * @return array<string, mixed> The parsed JSON response containing the current user data.
     *
     * @see https://radar.com/documentation/api/#get-current-user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // --------------------------------------------------------------------------
    // Events
    // --------------------------------------------------------------------------

    /**
     * List events with optional filters and pagination.
     *
     * @param  array  $filters  Query parameters such as `limit`, `cursor`, `type`, `userId`, etc.
     * @return array<string, mixed> The parsed JSON response containing events data.
     *
     * @see https://radar.com/documentation/api/#list-events
     */
    public function listEvents(array $filters = []): array
    {
        return $this->request('GET', '/events', $filters);
    }

    // --------------------------------------------------------------------------
    // HTTP layer
    // --------------------------------------------------------------------------

    /**
     * Make an authenticated API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path (e.g., "/geofences").
     * @param  array  $data  Request body (POST/PUT) or query parameters (GET).
     * @return array<string, mixed> The parsed JSON response body.
     *
     * @throws \RuntimeException When the API returns an error or the service is not configured.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Radar API.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the access token is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Radar access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Radar API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Radar API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Radar API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Radar API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Radar API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Radar API: {$e->getMessage()}");
        }
    }
}
