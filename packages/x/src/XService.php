<?php

namespace OpenCompany\Integrations\X;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Twitter/X API v2.
 *
 * Wraps all API communication. Tools call service methods — they never
 * make HTTP requests directly. Supports a configurable base URL so tests
 * or enterprise gateways can override the default {@see https://api.twitter.com/2}.
 */
class XService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.twitter.com/2',
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

    // ── Tweets ────────────────────────────────────────────

    /**
     * Get a single tweet by ID.
     *
     * @param string $id Tweet ID
     * @param array<string, mixed> $params Optional query parameters (e.g. expansions, tweet.fields)
     * @return array<string, mixed>
     */
    public function getTweet(string $id, array $params = []): array
    {
        return $this->request('GET', '/tweets/' . urlencode($id), $params);
    }

    /**
     * Look up multiple tweets by their IDs.
     *
     * @param array<int, string> $ids List of tweet IDs (max 100)
     * @param array<string, mixed> $params Optional query parameters
     * @return array<string, mixed>
     */
    public function listTweets(array $ids, array $params = []): array
    {
        $params['ids'] = implode(',', $ids);

        return $this->request('GET', '/tweets', $params);
    }

    /**
     * Create (post) a new tweet.
     *
     * @param array<string, mixed> $data Tweet payload (text, reply_settings, media, etc.)
     * @return array<string, mixed>
     */
    public function createTweet(array $data): array
    {
        return $this->request('POST', '/tweets', $data);
    }

    // ── Users ─────────────────────────────────────────────

    /**
     * Get a user by their numeric ID.
     *
     * @param string $id Twitter user ID
     * @param array<string, mixed> $params Optional query parameters (e.g. user.fields)
     * @return array<string, mixed>
     */
    public function getUser(string $id, array $params = []): array
    {
        return $this->request('GET', '/users/' . urlencode($id), $params);
    }

    /**
     * Get a user by their username (handle).
     *
     * @param string $username Twitter username without the @ prefix
     * @param array<string, mixed> $params Optional query parameters
     * @return array<string, mixed>
     */
    public function getUserByUsername(string $username, array $params = []): array
    {
        return $this->request('GET', '/users/by/username/' . urlencode($username), $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @param array<string, mixed> $params Optional query parameters
     * @return array<string, mixed>
     */
    public function getCurrentUser(array $params = []): array
    {
        return $this->request('GET', '/users/me', $params);
    }

    // ── HTTP ──────────────────────────────────────────────

    /**
     * Make an API request and return the parsed JSON response.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param string $path API path relative to the base URL
     * @param array<string, mixed> $data Query parameters or JSON body
     * @return array<string, mixed>
     *
     * @throws \RuntimeException When the request fails
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Twitter API.
     *
     * @param string $method HTTP method
     * @param string $path API path
     * @param array<string, mixed> $data Query parameters or JSON body
     *
     * @throws \RuntimeException When credentials are missing or the API returns an error
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Twitter access token is not configured.');
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
                    Log::warning("Twitter API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Twitter API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('title') ?? $body;
                Log::error("Twitter API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Twitter API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Twitter API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Twitter API: {$e->getMessage()}");
        }
    }
}
