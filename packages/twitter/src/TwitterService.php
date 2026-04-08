<?php

namespace OpenCompany\Integrations\Twitter;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TwitterService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.twitter.com/2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an access token configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the authenticated user's information.
     *
     * Calls `GET /2/users/me` with the Bearer token to retrieve
     * the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(array $tweetFields = [], array $userFields = []): array
    {
        $params = [];
        if (!empty($tweetFields)) {
            $params['tweet.fields'] = implode(',', $tweetFields);
        }
        if (!empty($userFields)) {
            $params['user.fields'] = implode(',', $userFields);
        }

        return $this->request('GET', '/2/users/me', $params);
    }

    /**
     * Get a single tweet by ID.
     *
     * Calls `GET /2/tweets/:id` to retrieve a tweet with optional expansions.
     *
     * @param  string  $id  The tweet ID.
     * @param  array<string>  $tweetFields  Additional tweet fields to include.
     * @param  array<string>  $expansions  Expansions to include (e.g. author_id).
     * @return array<string, mixed>
     */
    public function getTweet(string $id, array $tweetFields = [], array $expansions = []): array
    {
        $params = [];
        if (!empty($tweetFields)) {
            $params['tweet.fields'] = implode(',', $tweetFields);
        }
        if (!empty($expansions)) {
            $params['expansions'] = implode(',', $expansions);
        }

        return $this->request('GET', '/2/tweets/' . urlencode($id), $params);
    }

    /**
     * List tweets with pagination.
     *
     * Calls `GET /2/tweets` with optional max_results and pagination token.
     * Note: the Twitter API v2 endpoint for listing tweets requires filtering
     * by user ID or other criteria. This method retrieves recent tweets.
     *
     * @param  int  $maxResults  Number of tweets per page (5–100, default 10).
     * @param  string|null  $paginationToken  Token for the next page of results.
     * @param  array<string>  $tweetFields  Additional tweet fields to include.
     * @return array<string, mixed>
     */
    public function listTweets(int $maxResults = 10, ?string $paginationToken = null, array $tweetFields = []): array
    {
        $params = ['max_results' => min(max($maxResults, 5), 100)];
        if ($paginationToken) {
            $params['pagination_token'] = $paginationToken;
        }
        if (!empty($tweetFields)) {
            $params['tweet.fields'] = implode(',', $tweetFields);
        }

        return $this->request('GET', '/2/tweets', $params);
    }

    /**
     * Get a single user by ID.
     *
     * Calls `GET /2/users/:id` to retrieve a user's profile.
     *
     * @param  string  $id  The user ID.
     * @param  array<string>  $userFields  Additional user fields to include.
     * @return array<string, mixed>
     */
    public function getUser(string $id, array $userFields = []): array
    {
        $params = [];
        if (!empty($userFields)) {
            $params['user.fields'] = implode(',', $userFields);
        }

        return $this->request('GET', '/2/users/' . urlencode($id), $params);
    }

    /**
     * List users with pagination (followers / following for a user).
     *
     * Calls `GET /2/users/:id/followers` to retrieve users connected to a
     * given user ID with optional pagination.
     *
     * @param  string  $id  The user ID whose followers to list.
     * @param  int  $maxResults  Number of users per page (1–1000, default 100).
     * @param  string|null  $paginationToken  Token for the next page of results.
     * @param  array<string>  $userFields  Additional user fields to include.
     * @return array<string, mixed>
     */
    public function listUsers(string $id, int $maxResults = 100, ?string $paginationToken = null, array $userFields = []): array
    {
        $params = ['max_results' => min(max($maxResults, 1), 1000)];
        if ($paginationToken) {
            $params['pagination_token'] = $paginationToken;
        }
        if (!empty($userFields)) {
            $params['user.fields'] = implode(',', $userFields);
        }

        return $this->request('GET', '/2/users/' . urlencode($id) . '/followers', $params);
    }

    /**
     * Search recent tweets matching a query.
     *
     * Calls `GET /2/tweets/search/recent` with a search query and optional
     * pagination and field selection.
     *
     * @param  string  $query  The search query (up to 1024 characters).
     * @param  int  $maxResults  Number of tweets per page (10–100, default 10).
     * @param  string|null  $nextToken  Token for the next page of results.
     * @param  array<string>  $tweetFields  Additional tweet fields to include.
     * @param  array<string>  $expansions  Expansions to include (e.g. author_id).
     * @return array<string, mixed>
     */
    public function searchTweets(string $query, int $maxResults = 10, ?string $nextToken = null, array $tweetFields = [], array $expansions = []): array
    {
        $params = [
            'query' => $query,
            'max_results' => min(max($maxResults, 10), 100),
        ];
        if ($nextToken) {
            $params['next_token'] = $nextToken;
        }
        if (!empty($tweetFields)) {
            $params['tweet.fields'] = implode(',', $tweetFields);
        }
        if (!empty($expansions)) {
            $params['expansions'] = implode(',', $expansions);
        }

        return $this->request('GET', '/2/tweets/search/recent', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g. `/2/tweets`).
     * @param  array<string, mixed>  $params  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        $response = $this->rawRequest($method, $path, $params);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Twitter API v2.
     *
     * Sends an authenticated request using the configured Bearer token
     * and returns the raw Illuminate HTTP response for advanced handling.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $params  Query parameters (GET) or JSON body (POST/PUT).
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $params = []): \Illuminate\Http\Client\Response
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
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['title'] ?? $json['detail'] ?? $response->body();

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
