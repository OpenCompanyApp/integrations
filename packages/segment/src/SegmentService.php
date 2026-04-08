<?php

namespace OpenCompany\Integrations\Segment;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SegmentService
{
    public function __construct(
        private string $writeKey = '',
        private string $apiToken = '',
        private string $baseUrl = 'https://api.segment.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->writeKey) || !empty($this->apiToken);
    }

    /**
     * Identify a user with traits.
     *
     * Links metadata about a particular user to a known userId.
     *
     * @param  string  $userId  The ID for this user in your database.
     * @param  array<string, mixed>  $traits  Free-form dictionary of traits for the user.
     * @return array<string, mixed>
     */
    public function identify(string $userId, array $traits = []): array
    {
        return $this->trackingRequest('POST', '/identify', [
            'userId' => $userId,
            'traits' => $traits,
        ]);
    }

    /**
     * Track an event for a user.
     *
     * Records actions your users perform.
     *
     * @param  string  $event  The name of the event being tracked.
     * @param  string  $userId  The ID for this user in your database.
     * @param  array<string, mixed>  $properties  Free-form dictionary of event properties.
     * @return array<string, mixed>
     */
    public function track(string $event, string $userId, array $properties = []): array
    {
        return $this->trackingRequest('POST', '/track', [
            'event' => $event,
            'userId' => $userId,
            'properties' => $properties,
        ]);
    }

    /**
     * Record a page view.
     *
     * @param  string  $name  The name of the page viewed.
     * @param  string  $userId  The ID for this user in your database.
     * @param  array<string, mixed> $properties  Free-form dictionary of page properties.
     * @return array<string, mixed>
     */
    public function page(string $name, string $userId, array $properties = []): array
    {
        return $this->trackingRequest('POST', '/page', [
            'name' => $name,
            'userId' => $userId,
            'properties' => $properties,
        ]);
    }

    /**
     * Associate a user with a group.
     *
     * Lets you associate an individual user with a group.
     *
     * @param  string  $groupId  The ID for the group.
     * @param  string  $userId  The ID for this user in your database.
     * @param  array<string, mixed>  $traits  Free-form dictionary of traits for the group.
     * @return array<string, mixed>
     */
    public function group(string $groupId, string $userId, array $traits = []): array
    {
        return $this->trackingRequest('POST', '/group', [
            'groupId' => $groupId,
            'userId' => $userId,
            'traits' => $traits,
        ]);
    }

    /**
     * Get the current authenticated user.
     *
     * Uses the Segment Public API (requires API token).
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->publicApiRequest('GET', '/');
    }

    /**
     * Get a workspace by slug.
     *
     * @param  string  $slug  The workspace slug.
     * @return array<string, mixed>
     */
    public function getWorkspace(string $slug): array
    {
        return $this->publicApiRequest('GET', '/workspaces/' . urlencode($slug));
    }

    /**
     * List sources for a workspace.
     *
     * @param  string  $slug  The workspace slug.
     * @return array<string, mixed>
     */
    public function listSources(string $slug): array
    {
        return $this->publicApiRequest('GET', '/workspaces/' . urlencode($slug) . '/sources');
    }

    /**
     * Get a specific source from a workspace.
     *
     * @param  string  $slug  The workspace slug.
     * @param  string  $id  The source ID.
     * @return array<string, mixed>
     */
    public function getSource(string $slug, string $id): array
    {
        return $this->publicApiRequest('GET', '/workspaces/' . urlencode($slug) . '/sources/' . urlencode($id));
    }

    /**
     * Make a tracking API request (uses write key via Basic Auth).
     *
     * @return array<string, mixed>
     */
    private function trackingRequest(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data, true);
        return $response->json() ?? [];
    }

    /**
     * Make a Public API request (uses API token as Bearer).
     *
     * @return array<string, mixed>
     */
    private function publicApiRequest(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data, false);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Segment API.
     *
     * @param  bool  $useWriteKey  True for Tracking API (Basic Auth), false for Public API (Bearer token).
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $useWriteKey = true): \Illuminate\Http\Client\Response
    {
        $url = $this->baseUrl . $path;

        try {
            if ($useWriteKey) {
                if (!$this->writeKey) {
                    throw new \RuntimeException('Segment write key is not configured.');
                }
                $http = Http::withBasicAuth($this->writeKey, '')
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->timeout(30);
            } else {
                if (!$this->apiToken) {
                    throw new \RuntimeException('Segment API token is not configured.');
                }
                $http = Http::withToken($this->apiToken)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->timeout(30);
            }

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
                    Log::warning("Segment API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Segment API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Segment API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Segment API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Segment API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Segment API: {$e->getMessage()}");
        }
    }
}
