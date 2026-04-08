<?php

namespace OpenCompany\Integrations\Reddit;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RedditService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://oauth.reddit.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List posts from a subreddit or the front page.
     *
     * @param  string  $subreddit  Subreddit name (without r/ prefix). Empty for front page.
     * @param  string  $sort  Sort method: hot, new, top, rising, controversial (default: hot).
     * @param  int  $limit  Number of posts to return (default 25, max 100).
     * @param  string|null  $after  fullname of a post to fetch results after (for pagination).
     * @param  string|null  $before  fullname of a post to fetch results before (for pagination).
     * @return array<string, mixed>
     */
    public function listPosts(
        string $subreddit = '',
        string $sort = 'hot',
        int $limit = 25,
        ?string $after = null,
        ?string $before = null,
    ): array {
        $path = $subreddit !== '' ? "/r/{$subreddit}/{$sort}" : "/{$sort}";
        $params = ['limit' => $limit];

        if ($after !== null) {
            $params['after'] = $after;
        }
        if ($before !== null) {
            $params['before'] = $before;
        }

        return $this->request('GET', $path, $params);
    }

    /**
     * Get a single post by subreddit and post ID.
     *
     * @param  string  $subreddit  Subreddit name (without r/ prefix).
     * @param  string  $postId  The base36 post ID (e.g., "abc123").
     * @return array<string, mixed>
     */
    public function getPost(string $subreddit, string $postId): array
    {
        return $this->request('GET', "/r/{$subreddit}/comments/{$postId}");
    }

    /**
     * Submit a new post to a subreddit.
     *
     * @param  string  $subreddit  Subreddit name (without r/ prefix).
     * @param  string  $title  Post title.
     * @param  string  $kind  Post type: self (text), link, image, video.
     * @param  string  $text  Post body text (for self posts).
     * @param  string  $url  URL (for link posts).
     * @param  bool  $nsfw  Whether the post is NSFW.
     * @param  bool  $spoiler  Whether the post is a spoiler.
     * @return array<string, mixed>
     */
    public function createPost(
        string $subreddit,
        string $title,
        string $kind = 'self',
        string $text = '',
        string $url = '',
        bool $nsfw = false,
        bool $spoiler = false,
    ): array {
        $data = [
            'sr' => $subreddit,
            'title' => $title,
            'kind' => $kind,
        ];

        if ($text !== '') {
            $data['text'] = $text;
        }
        if ($url !== '') {
            $data['url'] = $url;
        }
        if ($nsfw) {
            $data['nsfw'] = true;
        }
        if ($spoiler) {
            $data['spoiler'] = true;
        }

        return $this->request('POST', '/submit', $data);
    }

    /**
     * List popular or new subreddits.
     *
     * @param  string  $sort  Sort method: popular or new (default: popular).
     * @param  int  $limit  Number of subreddits to return (default 25, max 100).
     * @param  string|null  $after  fullname of a subreddit for pagination.
     * @param  string|null  $before  fullname of a subreddit for pagination.
     * @return array<string, mixed>
     */
    public function listSubreddits(
        string $sort = 'popular',
        int $limit = 25,
        ?string $after = null,
        ?string $before = null,
    ): array {
        $params = ['limit' => $limit];

        if ($after !== null) {
            $params['after'] = $after;
        }
        if ($before !== null) {
            $params['before'] = $before;
        }

        return $this->request('GET', "/subreddits/{$sort}", $params);
    }

    /**
     * Get information about a specific subreddit.
     *
     * @param  string  $subreddit  Subreddit name (without r/ prefix).
     * @return array<string, mixed>
     */
    public function getSubreddit(string $subreddit): array
    {
        return $this->request('GET', "/r/{$subreddit}/about");
    }

    /**
     * List comments for a specific post.
     *
     * @param  string  $subreddit  Subreddit name (without r/ prefix).
     * @param  string  $postId  The base36 post ID.
     * @param  int  $limit  Maximum number of comments to return (default 25, max 100).
     * @param  string  $sort  Comment sort: best, top, new, controversial, old, q&a (default: best).
     * @param  int  $depth  Maximum comment depth (default: unlimited).
     * @return array<string, mixed>
     */
    public function listComments(
        string $subreddit,
        string $postId,
        int $limit = 25,
        string $sort = 'best',
        int $depth = 0,
    ): array {
        $params = [
            'limit' => $limit,
            'sort' => $sort,
        ];

        if ($depth > 0) {
            $params['depth'] = $depth;
        }

        return $this->request('GET', "/r/{$subreddit}/comments/{$postId}", $params);
    }

    /**
     * Post a comment on a post or reply to another comment.
     *
     * @param  string  $parent  Fullname of the thing to comment on (t3_ for posts, t1_ for comments).
     * @param  string  $text  Comment body (supports Markdown).
     * @return array<string, mixed>
     */
    public function createComment(string $parent, string $text): array
    {
        return $this->request('POST', '/api/comment', [
            'parent' => $parent,
            'text' => $text,
        ]);
    }

    /**
     * Search Reddit for posts, subreddits, and users.
     *
     * @param  string  $query  Search query string.
     * @param  string  $type  Result type: link (posts), sr (subreddits), user, or comma-separated.
     * @param  string  $sort  Sort order: relevance, hot, top, new, comments (default: relevance).
     * @param  string  $time  Time range: hour, day, week, month, year, all (default: all).
     * @param  int  $limit  Maximum number of results (default 25, max 100).
     * @param  string|null  $after  Pagination cursor (fullname of last result).
     * @return array<string, mixed>
     */
    public function search(
        string $query,
        string $type = 'link',
        string $sort = 'relevance',
        string $time = 'all',
        int $limit = 25,
        ?string $after = null,
    ): array {
        $params = [
            'q' => $query,
            'type' => $type,
            'sort' => $sort,
            't' => $time,
            'limit' => $limit,
        ];

        if ($after !== null) {
            $params['after'] = $after;
        }

        return $this->request('GET', '/search', $params);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g., "/me").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Reddit API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Reddit API access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'User-Agent' => 'OpenCompany-Integrations/1.0',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asForm()->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Reddit API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Reddit API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

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
