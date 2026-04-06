<?php

namespace OpenCompany\Integrations\Amplitude;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * AmplitudeService — HTTP client for the Amplitude Analytics API.
 *
 * Wraps all Amplitude v2 REST endpoints used by the integration tools.
 * Authentication is via Bearer token passed in the Authorization header.
 */
class AmplitudeService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://amplitude.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List events from the Amplitude events API.
     *
     * @param  string|null  $userId   Filter by user ID (Amplitude user_id).
     * @param  string|null  $deviceId Filter by device ID.
     * @param  string|null  $start    Start timestamp (ISO 8601 or milliseconds epoch).
     * @param  string|null  $end      End timestamp (ISO 8601 or milliseconds epoch).
     * @param  int          $limit    Maximum number of events to return (default 1000).
     * @return array<string, mixed>
     */
    public function listEvents(
        ?string $userId = null,
        ?string $deviceId = null,
        ?string $start = null,
        ?string $end = null,
        int $limit = 1000,
    ): array {
        $params = ['limit' => $limit];

        if ($userId !== null) {
            $params['user_id'] = $userId;
        }
        if ($deviceId !== null) {
            $params['device_id'] = $deviceId;
        }
        if ($start !== null) {
            $params['start'] = $start;
        }
        if ($end !== null) {
            $params['end'] = $end;
        }

        return $this->request('GET', '/api/2/events', $params);
    }

    /**
     * Get a single event by its ID.
     *
     * @param  string|int  $id  The Amplitude event ID.
     * @return array<string, mixed>
     */
    public function getEvent(string|int $id): array
    {
        return $this->request('GET', '/api/2/events/' . urlencode((string) $id));
    }

    /**
     * Search for users matching a query string.
     *
     * @param  string  $query  Search term (user ID, name, email, etc.).
     * @param  int     $limit  Maximum number of users to return (default 100).
     * @return array<string, mixed>
     */
    public function listUsers(string $query, int $limit = 100): array
    {
        return $this->request('GET', '/api/2/usersearch', [
            'query' => $query,
            'limit' => $limit,
        ]);
    }

    /**
     * Get the full user profile for a user.
     *
     * @param  string|null  $userId   The Amplitude user_id.
     * @param  string|null  $deviceId The Amplitude device_id.
     * @return array<string, mixed>
     */
    public function getUser(?string $userId = null, ?string $deviceId = null): array
    {
        $params = [];
        if ($userId !== null) {
            $params['user_id'] = $userId;
        }
        if ($deviceId !== null) {
            $params['device_id'] = $deviceId;
        }

        return $this->request('GET', '/api/2/userprofile', $params);
    }

    /**
     * List properties (event or user) available in the Amplitude project.
     *
     * @param  string  $type  Property type: "event" or "user" (default "event").
     * @return array<string, mixed>
     */
    public function listProperties(string $type = 'event'): array
    {
        return $this->request('GET', '/api/2/properties', [
            'type' => $type,
        ]);
    }

    /**
     * Search for groups matching a query string.
     *
     * @param  string  $query  Search term for group name or ID.
     * @param  int     $limit  Maximum number of groups to return (default 100).
     * @return array<string, mixed>
     */
    public function listGroups(string $query, int $limit = 100): array
    {
        return $this->request('GET', '/api/2/groupsearch', [
            'query' => $query,
            'limit' => $limit,
        ]);
    }

    /**
     * Get the currently authenticated user (caller identity).
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/2/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/api/2/events").
     * @param  array   $data    Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Amplitude API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection failure or non-2xx response.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Amplitude API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Amplitude API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Amplitude API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Amplitude API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);
                throw new \RuntimeException("Amplitude API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Amplitude API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Amplitude API: {$e->getMessage()}");
        }
    }
}
