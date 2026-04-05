<?php

namespace OpenCompany\Integrations\Vero;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VeroService
{
    public function __construct(
        private string $authToken = '',
        private string $baseUrl = 'https://api.getvero.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Vero integration is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->authToken);
    }

    /**
     * Identify (or re-identify) a user in Vero.
     *
     * @param  string|int  $identity  Unique user identifier (id or email)
     * @param  string|null $email     User email address
     * @param  string|null $name      User full name
     * @param  array<string, mixed>  $extra  Additional user traits
     * @return array<string, mixed>
     */
    public function identifyUser(string|int $identity, ?string $email = null, ?string $name = null, array $extra = []): array
    {
        $data = [
            'identity' => ['id' => (string) $identity],
        ];

        if ($email !== null) {
            $data['identity']['email'] = $email;
        }

        if ($name !== null) {
            $data['identity']['name'] = $name;
        }

        if (!empty($extra)) {
            $data['identity']['data'] = $extra;
        }

        return $this->request('POST', '/users/track', $data);
    }

    /**
     * Track an event for a user in Vero.
     *
     * @param  string|int  $identity   Unique user identifier
     * @param  string      $eventName  Name of the event to track
     * @param  array<string, mixed>  $data  Additional event properties
     * @return array<string, mixed>
     */
    public function trackEvent(string|int $identity, string $eventName, array $data = []): array
    {
        $payload = [
            'identity' => ['id' => (string) $identity],
            'event_name' => $eventName,
        ];

        if (!empty($data)) {
            $payload['data'] = $data;
        }

        return $this->request('POST', '/events/track', $payload);
    }

    /**
     * Update a user's profile in Vero.
     *
     * @param  string|int  $identity  Unique user identifier
     * @param  array<string, mixed>  $changes  Key-value pairs of attributes to update
     * @return array<string, mixed>
     */
    public function updateUser(string|int $identity, array $changes): array
    {
        return $this->request('PUT', '/users/edit', [
            'identity' => ['id' => (string) $identity],
            'changes' => $changes,
        ]);
    }

    /**
     * Add one or more tags to a user in Vero.
     *
     * @param  string|int  $identity  Unique user identifier
     * @param  array<int, string>  $tags  Tags to add
     * @return array<string, mixed>
     */
    public function addTag(string|int $identity, array $tags): array
    {
        return $this->request('POST', '/users/tags/add', [
            'identity' => ['id' => (string) $identity],
            'tags' => $tags,
        ]);
    }

    /**
     * Remove one or more tags from a user in Vero.
     *
     * @param  string|int  $identity  Unique user identifier
     * @param  array<int, string>  $tags  Tags to remove
     * @return array<string, mixed>
     */
    public function removeTag(string|int $identity, array $tags): array
    {
        return $this->request('POST', '/users/tags/remove', [
            'identity' => ['id' => (string) $identity],
            'tags' => $tags,
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API endpoint path
     * @param  array<string, mixed>  $data  Request payload
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        $body = $response->json();

        if (is_array($body)) {
            return $body;
        }

        return ['status' => $response->status(), 'message' => $response->body()];
    }

    /**
     * Make a raw HTTP request to the Vero API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path    API endpoint path
     * @param  array<string, mixed>  $data  Request payload
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->authToken) {
            throw new \RuntimeException('Vero auth token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => $this->authToken,
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
                    Log::warning("Vero API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Vero API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Vero API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Vero API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Vero API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Vero API: {$e->getMessage()}");
        }
    }
}
