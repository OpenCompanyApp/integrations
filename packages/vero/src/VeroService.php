<?php

namespace OpenCompany\Integrations\Vero;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Vero email marketing API client.
 *
 * Wraps the Vero REST API (v2) for user identity management,
 * event tracking, and subscription control.
 */
class VeroService
{
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
        return ! empty($this->authToken);
    }

    // ── Users ─────────────────────────────────────────────

    /**
     * Identify (create or update) a user in Vero.
     *
     * @param  string  $id     Unique user identifier.
     * @param  string  $email  User email address.
     * @param  string  $name   Display name.
     * @param  array<string, mixed>  $data  Additional user attributes.
     * @return array<string, mixed>
     */
    public function identifyUser(string $id, string $email, string $name = '', array $data = []): array
    {
        $payload = [
            'id' => $id,
            'email' => $email,
        ];

        if ($name !== '') {
            $payload['name'] = $name;
        }

        if (! empty($data)) {
            $payload['data'] = $data;
        }

        return $this->request('POST', '/users/identify', $payload);
    }

    /**
     * Track an event for a user.
     *
     * @param  string  $identity   User ID or email.
     * @param  string  $eventName  Name of the event to track.
     * @param  array<string, mixed>  $data  Event-specific data.
     * @return array<string, mixed>
     */
    public function trackEvent(string $identity, string $eventName, array $data = []): array
    {
        $payload = [
            'identity' => $identity,
            'event_name' => $eventName,
        ];

        if (! empty($data)) {
            $payload['data'] = $data;
        }

        return $this->request('POST', '/users/track', $payload);
    }

    /**
     * Update a user's profile data.
     *
     * @param  string  $id    Unique user identifier.
     * @param  string  $email Updated email address.
     * @param  array<string, mixed>  $data  Attributes to update.
     * @return array<string, mixed>
     */
    public function updateUser(string $id, string $email = '', array $data = []): array
    {
        $payload = [];

        if ($email !== '') {
            $payload['email'] = $email;
        }

        if (! empty($data)) {
            $payload['data'] = $data;
        }

        return $this->request('PUT', '/users/' . urlencode($id), $payload);
    }

    /**
     * Unsubscribe a user from all email communication.
     *
     * @param  string  $id  Unique user identifier.
     * @return array<string, mixed>
     */
    public function unsubscribe(string $id): array
    {
        return $this->request('POST', '/users/unsubscribe', [
            'id' => $id,
        ]);
    }

    /**
     * Resubscribe a user to email communication.
     *
     * @param  string  $id  Unique user identifier.
     * @return array<string, mixed>
     */
    public function resubscribe(string $id): array
    {
        return $this->request('POST', '/users/resubscribe', [
            'id' => $id,
        ]);
    }

    /**
     * Get the currently authenticated user profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── HTTP ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->authToken) {
            throw new \RuntimeException('Vero auth token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->authToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Vero API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Vero API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Vero API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Vero API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Vero API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Vero API: {$e->getMessage()}");
        }
    }
}
