<?php

namespace OpenCompany\Integrations\Vero;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Vero Track REST API.
 *
 * Handles auth-token query parameters, request dispatch, error logging, and
 * response parsing for user, tag, event, and generic API operations.
 */
class VeroService
{
    /**
     * @param  string  $authToken  Vero Track API authentication token.
     * @param  string  $baseUrl  Base URL for the Vero Track REST API.
     */
    public function __construct(
        private string $authToken = '',
        private string $baseUrl = 'https://api.getvero.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Vero auth token is configured.
     */
    public function isConfigured(): bool
    {
        return $this->authToken !== '';
    }

    // Users

    /**
     * Identify or update a user in Vero.
     *
     * @param  string  $id  Unique user identifier.
     * @param  string  $email  User email address.
     * @param  string  $name  Optional display name, added to data as name.
     * @param  array<string, mixed>  $data  Custom user attributes.
     * @param  array<int, array<string, mixed>>  $channels  Optional channel records such as push tokens.
     * @return array<string, mixed>
     */
    public function identifyUser(string $id, string $email, string $name = '', array $data = [], array $channels = []): array
    {
        $payload = [
            'id' => $id,
            'email' => $email,
        ];

        if ($name !== '') {
            $data['name'] = $name;
        }

        if ($data !== []) {
            $payload['data'] = $data;
        }

        if ($channels !== []) {
            $payload['channels'] = $channels;
        }

        return $this->request('POST', '/users/track', $payload);
    }

    /**
     * Update user profile data via Vero's identify endpoint.
     *
     * @param  string  $id  Unique user identifier.
     * @param  string  $email  Optional email address.
     * @param  array<string, mixed>  $data  Custom user attributes.
     * @return array<string, mixed>
     */
    public function updateUser(string $id, string $email = '', array $data = []): array
    {
        $payload = ['id' => $id];

        if ($email !== '') {
            $payload['email'] = $email;
        }

        if ($data !== []) {
            $payload['data'] = $data;
        }

        return $this->request('POST', '/users/track', $payload);
    }

    /**
     * Change a user's identifier, merging the old identity into the new one.
     *
     * @param  string  $id  Existing user identifier.
     * @param  string  $newId  Replacement user identifier.
     * @return array<string, mixed>
     */
    public function aliasUser(string $id, string $newId): array
    {
        return $this->request('PUT', '/users/reidentify', [
            'id' => $id,
            'new_id' => $newId,
        ]);
    }

    /**
     * Globally unsubscribe a user.
     *
     * @param  string  $id  Unique user identifier.
     * @return array<string, mixed>
     */
    public function unsubscribe(string $id): array
    {
        return $this->request('POST', '/users/unsubscribe', ['id' => $id]);
    }

    /**
     * Globally resubscribe a user.
     *
     * @param  string  $id  Unique user identifier.
     * @return array<string, mixed>
     */
    public function resubscribe(string $id): array
    {
        return $this->request('POST', '/users/resubscribe', ['id' => $id]);
    }

    /**
     * Delete a user and all tracked activity from Vero.
     *
     * @param  string  $id  Unique user identifier.
     * @return array<string, mixed>
     */
    public function deleteUser(string $id): array
    {
        return $this->request('POST', '/users/delete', ['id' => $id]);
    }

    /**
     * Return local connection status for the configured Track API token.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Vero auth token is not configured.');
        }

        return [
            'configured' => true,
            'base_url' => $this->baseUrl,
            'message' => 'Vero Track API does not provide a current-user endpoint; API access is verified when a tool sends data.',
        ];
    }

    // Tags

    /**
     * Add or remove tags on a user profile.
     *
     * @param  string  $id  Unique user identifier.
     * @param  array<int, string>  $add  Tags to add.
     * @param  array<int, string>  $remove  Tags to remove.
     * @return array<string, mixed>
     */
    public function editTags(string $id, array $add = [], array $remove = []): array
    {
        return $this->request('PUT', '/users/tags/edit', [
            'id' => $id,
            'add' => array_values($add),
            'remove' => array_values($remove),
        ]);
    }

    // Events

    /**
     * Track an event for a user.
     *
     * @param  array<string, mixed>|string  $identity  User identity hash, or a legacy ID/email string.
     * @param  string  $eventName  Name of the event to track.
     * @param  array<string, mixed>  $data  Event properties.
     * @param  array<string, mixed>  $extras  Vero-specific extras such as source or created_at.
     * @return array<string, mixed>
     */
    public function trackEvent(array|string $identity, string $eventName, array $data = [], array $extras = []): array
    {
        $payload = [
            'identity' => is_array($identity) ? $identity : ['id' => $identity],
            'event_name' => $eventName,
        ];

        if ($data !== []) {
            $payload['data'] = $data;
        }

        if ($extras !== []) {
            $payload['extras'] = $extras;
        }

        return $this->request('POST', '/events/track', $payload);
    }

    // Generic API

    /**
     * Send a GET request to a relative Vero API path.
     *
     * @param  string  $path  Relative path such as /campaigns.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to a relative Vero API path.
     *
     * @param  string  $path  Relative path such as /users/track.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PUT request to a relative Vero API path.
     *
     * @param  string  $path  Relative path such as /users/tags/edit.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to a relative Vero API path.
     *
     * @param  string  $path  Relative path.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Vero auth token is not configured.');
        }

        $method = strtoupper($method);
        $url = $this->baseUrl.$path;
        $query = ['auth_token' => $this->authToken];

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match ($method) {
                'GET' => $http->get($url, $query + $data),
                'POST' => $http->withQueryParameters($query)->post($url, $data),
                'PUT' => $http->withQueryParameters($query)->put($url, $data),
                'DELETE' => $http->withQueryParameters($query)->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();

                Log::error("Vero API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("Vero API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error("Vero API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to Vero API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize and validate a caller-supplied relative path.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || str_contains($path, '://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Vero API path must be a relative path such as /users/track.');
        }

        return str_starts_with($path, '/') ? $path : '/'.$path;
    }
}
