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
     * Check whether the Twitter integration is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the authenticated user's profile.
     *
     * Calls `GET /users/me` with default user fields.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(array $userFields = []): array
    {
        $params = [];
        if (!empty($userFields)) {
            $params['user.fields'] = implode(',', $userFields);
        }

        return $this->request('GET', '/users/me', $params);
    }

    /**
     * Get a user by their numeric ID.
     *
     * Calls `GET /users/{id}`.
     *
     * @param  string  $id  The Twitter user ID.
     * @param  array<string>  $userFields  Optional user.fields expansion.
     * @return array<string, mixed>
     */
    public function getUser(string $id, array $userFields = []): array
    {
        $params = [];
        if (!empty($userFields)) {
            $params['user.fields'] = implode(',', $userFields);
        }

        return $this->request('GET', '/users/' . urlencode($id), $params);
    }

    /**
     * Get a user by their username (handle).
     *
     * Calls `GET /users/by/username/{username}`.
     *
     * @param  string  $username  The Twitter username (without @).
     * @param  array<string>  $userFields  Optional user.fields expansion.
     * @return array<string, mixed>
     */
    public function getUserByUsername(string $username, array $userFields = []): array
    {
        $params = [];
        if (!empty($userFields)) {
            $params['user.fields'] = implode(',', $userFields);
        }

        return $this->request('GET', '/users/by/username/' . urlencode($username), $params);
    }

    /**
     * List recent tweets for a user.
     *
     * Calls `GET /users/{id}/tweets`.
     *
     * @param  string  $userId  The Twitter user ID.
     * @param  int  $maxResults  Number of tweets to return (10–100, default 10).
     * @param  array<string>  $tweetFields  Optional tweet.fields expansion.
     * @param  string|null  $paginationToken  Token for paginating through results.
     * @return array<string, mixed>
     */
    public function listTweets(string $userId, int $maxResults = 10, array $tweetFields = [], ?string $paginationToken = null): array
    {
        $params = [
            'max_results' => max(10, min(100, $maxResults)),
        ];

        if (!empty($tweetFields)) {
            $params['tweet.fields'] = implode(',', $tweetFields);
        }

        if ($paginationToken !== null) {
            $params['pagination_token'] = $paginationToken;
        }

        return $this->request('GET', '/users/' . urlencode($userId) . '/tweets', $params);
    }

    /**
     * Create (post) a new tweet.
     *
     * Calls `POST /tweets`.
     *
     * @param  string  $text  The tweet text content.
     * @param  array<string, mixed>  $options  Additional payload options (reply_settings, media, etc.).
     * @return array<string, mixed>
     */
    public function createTweet(string $text, array $options = []): array
    {
        $payload = array_merge(['text' => $text], $options);

        return $this->request('POST', '/tweets', $payload);
    }

    /**
     * Delete a tweet by ID.
     *
     * Calls `DELETE /tweets/{id}`.
     *
     * @param  string  $tweetId  The ID of the tweet to delete.
     * @return array<string, mixed>
     */
    public function deleteTweet(string $tweetId): array
    {
        return $this->request('DELETE', '/tweets/' . urlencode($tweetId));
    }

    /**
     * Search recent tweets (last 7 days).
     *
     * Calls `GET /tweets/search/recent`.
     *
     * @param  string  $query  The search query (supports Twitter operators).
     * @param  int  $maxResults  Number of tweets to return (10–100, default 10).
     * @param  array<string>  $tweetFields  Optional tweet.fields expansion.
     * @param  string|null  $nextToken  Token for paginating through results.
     * @return array<string, mixed>
     */
    public function searchTweets(string $query, int $maxResults = 10, array $tweetFields = [], ?string $nextToken = null): array
    {
        $params = [
            'query' => $query,
            'max_results' => max(10, min(100, $maxResults)),
        ];

        if (!empty($tweetFields)) {
            $params['tweet.fields'] = implode(',', $tweetFields);
        }

        if ($nextToken !== null) {
            $params['next_token'] = $nextToken;
        }

        return $this->request('GET', '/tweets/search/recent', $params);
    }

    /**
     * Get a single tweet by ID.
     *
     * Calls `GET /tweets/{id}`.
     *
     * @param  string  $tweetId  The tweet ID.
     * @param  array<string>  $tweetFields  Optional tweet.fields expansion.
     * @return array<string, mixed>
     */
    public function getTweet(string $tweetId, array $tweetFields = []): array
    {
        $params = [];
        if (!empty($tweetFields)) {
            $params['tweet.fields'] = implode(',', $tweetFields);
        }

        return $this->request('GET', '/tweets/' . urlencode($tweetId), $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., `/users/me`).
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Twitter API v2.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., `/users/me`).
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the access token is missing, the request fails, or a connection error occurs.
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
