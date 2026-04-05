<?php

namespace OpenCompany\Integrations\Reddit;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Reddit API service for making authenticated requests to the Reddit OAuth2 API.
 *
 * Handles authentication via Bearer tokens, request formatting, error handling,
 * and response parsing for all Reddit API endpoints.
 */
class RedditService
{
    /**
     * Create a new RedditService instance.
     *
     * @param  string  $accessToken  OAuth2 access token for Reddit API authentication.
     * @param  string  $baseUrl  Base URL for the Reddit OAuth2 API.
     * @param  string  $userAgent  User-Agent string identifying the client to Reddit's API.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://oauth.reddit.com',
        private string $userAgent = 'OpenCompany/1.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get hot posts from a subreddit.
     *
     * @param  string  $subreddit  The subreddit name (without r/ prefix).
     * @param  int  $limit  Maximum number of posts to return (default 25, max 100).
     * @param  string|null  $after  fullname of a post to use as pagination cursor.
     * @param  string|null  $before  fullname of a post to use as pagination cursor (backward).
     * @return array<string, mixed> Parsed API response containing post listings.
     */
    public function listPosts(string $subreddit, int $limit = 25, ?string $after = null, ?string $before = null): array
    {
        $params = ['limit' => min($limit, 100)];
        if ($after) {
            $params['after'] = $after;
        }
        if ($before) {
            $params['before'] = $before;
        }

        return $this->request('GET', "/r/{$subreddit}/hot", $params);
    }

    /**
     * Get a specific post with its comments.
     *
     * @param  string  $id  The base36 post ID (e.g., "abc123").
     * @param  int  $commentLimit  Maximum number of comments to return (default 25, max 100).
     * @param  bool  $deep  Whether to expand comment replies.
     * @return array<string, mixed> Parsed API response containing the post and its comments.
     */
    public function getPost(string $id, int $commentLimit = 25, bool $deep = false): array
    {
        $params = [
            'limit' => min($commentLimit, 100),
            'raw_json' => 1,
        ];
        if (!$deep) {
            $params['depth'] = 2;
        }

        return $this->request('GET', "/comments/{$id}", $params);
    }

    /**
     * Submit a new post to a subreddit.
     *
     * @param  string  $subreddit  The subreddit name (without r/ prefix).
     * @param  string  $title  The post title.
     * @param  string  $kind  Post type: "self" (text), "link", "image", or "video".
     * @param  string|null  $text  Post body text (required for "self" posts).
     * @param  string|null  $url  URL for "link", "image", or "video" posts.
     * @param  bool  $resubmit  Whether to resubmit a link that has been previously submitted.
     * @return array<string, mixed> Parsed API response containing the created post data.
     */
    public function createPost(string $subreddit, string $title, string $kind = 'self', ?string $text = null, ?string $url = null, bool $resubmit = true): array
    {
        $data = [
            'sr' => $subreddit,
            'title' => $title,
            'kind' => $kind,
            'resubmit' => $resubmit,
        ];

        if ($text !== null) {
            $data['text'] = $text;
        }
        if ($url !== null) {
            $data['url'] = $url;
        }

        return $this->request('POST', '/api/submit', $data);
    }

    /**
     * Search Reddit for posts and subreddits.
     *
     * @param  string  $query  The search query string.
     * @param  string  $type  Result type filter: "link", "sr", "user", or combinations (e.g., "link,sr").
     * @param  string  $sort  Sort order: "relevance", "hot", "top", "new", or "comments".
     * @param  string  $time  Time range: "hour", "day", "week", "month", "year", or "all".
     * @param  int  $limit  Maximum number of results (default 25, max 100).
     * @param  string|null  $after  Pagination cursor — fullname of the last result.
     * @return array<string, mixed> Parsed API response containing search results.
     */
    public function search(string $query, string $type = 'link', string $sort = 'relevance', string $time = 'all', int $limit = 25, ?string $after = null): array
    {
        $params = [
            'q' => $query,
            'type' => $type,
            'sort' => $sort,
            't' => $time,
            'limit' => min($limit, 100),
            'raw_json' => 1,
        ];
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/search', $params);
    }

    /**
     * List popular subreddits.
     *
     * @param  int  $limit  Maximum number of subreddits to return (default 25, max 100).
     * @param  string|null  $after  Pagination cursor — fullname of the last result.
     * @return array<string, mixed> Parsed API response containing subreddit listings.
     */
    public function listSubreddits(int $limit = 25, ?string $after = null): array
    {
        $params = ['limit' => min($limit, 100)];
        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/subreddits/popular', $params);
    }

    /**
     * Get detailed information about a subreddit.
     *
     * @param  string  $name  The subreddit name (without r/ prefix).
     * @return array<string, mixed> Parsed API response containing subreddit details.
     */
    public function getSubreddit(string $name): array
    {
        return $this->request('GET', "/r/{$name}/about");
    }

    /**
     * Post a comment on a post or reply to another comment.
     *
     * @param  string  $parent  The fullname of the parent thing (post or comment), e.g. "t3_abc123" or "t1_def456".
     * @param  string  $text  The comment body (supports Markdown).
     * @return array<string, mixed> Parsed API response containing the created comment data.
     */
    public function createComment(string $parent, string $text): array
    {
        return $this->request('POST', '/api/comment', [
            'parent' => $parent,
            'text' => $text,
        ]);
    }

    /**
     * Get the currently authenticated user's profile information.
     *
     * @return array<string, mixed> Parsed API response containing the user's profile data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE, PATCH).
     * @param  string  $path  API endpoint path (e.g., "/r/laravel/hot").
     * @param  array<string, mixed>  $data  Query parameters (GET) or form data (POST).
     * @return array<string, mixed> Decoded JSON response body.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        $json = $response->json();

        // Reddit returns a two-element array for /comments/{id} (post + comments)
        if (is_array($json)) {
            return $json;
        }

        return $json ?? [];
    }

    /**
     * Make a raw HTTP request to the Reddit OAuth2 API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE, PATCH).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or form data.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If not configured or the request encounters an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Reddit access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'User-Agent' => $this->userAgent,
            ])->timeout(30);

            // Reddit POST endpoints expect form-encoded data
            if (in_array(strtoupper($method), ['POST', 'PUT', 'PATCH'])) {
                $http = $http->asForm();
            }

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $body = $response->body();
                $json = $response->json();
                $error = $json['message'] ?? $json['error'] ?? $body;

                Log::error("Reddit API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Reddit API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Reddit API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Reddit API: {$e->getMessage()}");
        }
    }
}
