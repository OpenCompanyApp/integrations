<?php

namespace OpenCompany\Integrations\Mastodon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * MastodonService — HTTP client for the Mastodon API.
 *
 * Handles authentication via Bearer token and provides methods for
 * statuses, accounts, and timelines endpoints.
 */
class MastodonService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://mastodon.social',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the configured instance base URL.
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Retrieve statuses from a timeline.
     *
     * @param  string  $timeline  Timeline type: home, local, public, or a list ID.
     * @param  int  $limit  Maximum number of statuses to return (max 40).
     * @param  string|null  $maxId  Return results older than this ID (for pagination).
     * @param  string|null  $sinceId  Return results newer than this ID (for pagination).
     * @return array<int, array<string, mixed>>
     */
    public function listStatuses(string $timeline = 'home', int $limit = 20, ?string $maxId = null, ?string $sinceId = null): array
    {
        $params = ['limit' => min($limit, 40)];
        if ($maxId !== null) {
            $params['max_id'] = $maxId;
        }
        if ($sinceId !== null) {
            $params['since_id'] = $sinceId;
        }

        $path = match ($timeline) {
            'home' => '/api/v1/timelines/home',
            'public' => '/api/v1/timelines/public',
            'local' => '/api/v1/timelines/public',
            default => str_starts_with($timeline, 'list:') ? '/api/v1/timelines/list/'.substr($timeline, 5) : "/api/v1/timelines/{$timeline}",
        };

        if ($timeline === 'local') {
            $params['local'] = true;
        }

        return $this->request('GET', $path, $params);
    }

    /**
     * Retrieve a single status by ID.
     *
     * @param  string  $id  The status ID.
     * @return array<string, mixed>
     */
    public function getStatus(string $id): array
    {
        return $this->request('GET', "/api/v1/statuses/{$id}");
    }

    /**
     * Publish a new status (toot).
     *
     * @param  string  $status  The text content of the status.
     * @param  string|null  $inReplyToId  ID of the status to reply to.
     * @param  bool  $sensitive  Whether the status contains sensitive media.
     * @param  string|null  $spoilerText  Content warning text.
     * @param  string|null  $visibility  Visibility: public, unlisted, private, or direct.
     * @param  string|null  $language  ISO 639-1 language code (e.g., "en").
     * @return array<string, mixed>
     */
    public function createStatus(
        string $status,
        ?string $inReplyToId = null,
        bool $sensitive = false,
        ?string $spoilerText = null,
        ?string $visibility = null,
        ?string $language = null,
    ): array {
        $data = [
            'status' => $status,
            'sensitive' => $sensitive,
        ];

        if ($inReplyToId !== null) {
            $data['in_reply_to_id'] = $inReplyToId;
        }
        if ($spoilerText !== null) {
            $data['spoiler_text'] = $spoilerText;
        }
        if ($visibility !== null) {
            $data['visibility'] = $visibility;
        }
        if ($language !== null) {
            $data['language'] = $language;
        }

        return $this->request('POST', '/api/v1/statuses', $data);
    }

    /**
     * Retrieve followers (or following) of an account.
     *
     * @param  string  $id  The account ID.
     * @param  int  $limit  Maximum number of accounts to return (max 80).
     * @param  string|null  $maxId  Return results older than this ID (for pagination).
     * @return array<int, array<string, mixed>>
     */
    public function listAccounts(string $id, int $limit = 40, ?string $maxId = null): array
    {
        $params = ['limit' => min($limit, 80)];
        if ($maxId !== null) {
            $params['max_id'] = $maxId;
        }

        return $this->request('GET', "/api/v1/accounts/{$id}/followers", $params);
    }

    /**
     * Retrieve a single account by ID.
     *
     * @param  string  $id  The account ID.
     * @return array<string, mixed>
     */
    public function getAccount(string $id): array
    {
        return $this->request('GET', "/api/v1/accounts/{$id}");
    }

    /**
     * Retrieve the currently authenticated user's account.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/accounts/verify_credentials');
    }

    /**
     * Call any Mastodon GET API endpoint relative to the instance base URL.
     *
     * @param  string  $path  API path beginning with /api/.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizeApiPath($path), $params);
    }

    /**
     * Call any Mastodon POST API endpoint relative to the instance base URL.
     *
     * @param  string  $path  API path beginning with /api/.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $this->normalizeApiPath($path), $body);
    }

    /**
     * Call any Mastodon PUT/PATCH API endpoint relative to the instance base URL.
     *
     * @param  string  $path  API path beginning with /api/.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = []): array
    {
        return $this->request('PUT', $this->normalizeApiPath($path), $body);
    }

    /**
     * Call any Mastodon DELETE API endpoint relative to the instance base URL.
     *
     * @param  string  $path  API path beginning with /api/.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $this->normalizeApiPath($path), $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Normalize a user-supplied API path for generic tools.
     */
    private function normalizeApiPath(string $path): string
    {
        $path = '/'.ltrim($path, '/');

        if (! str_starts_with($path, '/api/')) {
            throw new \RuntimeException('Mastodon generic API path must start with /api/.');
        }

        return $path;
    }

    /**
     * Make a raw HTTP request to the Mastodon API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Mastodon access token is not configured.');
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Mastodon API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Mastodon API endpoint not available (HTTP {$response->status()}). Check your instance URL.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Mastodon API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Mastodon API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mastodon API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mastodon API: {$e->getMessage()}");
        }
    }
}
