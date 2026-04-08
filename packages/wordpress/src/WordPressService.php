<?php

namespace OpenCompany\Integrations\WordPress;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * WordPress REST API service — handles HTTP communication with a WordPress site.
 *
 * Authenticates via HTTP Basic Auth using an application password.
 * The base URL should point to the wp-json endpoint, e.g. https://yourdomain.com/wp-json.
 */
class WordPressService
{
    /**
     * Create a new WordPressService instance.
     *
     * @param string $username           WordPress username for HTTP Basic Auth.
     * @param string $applicationPassword WordPress application password for HTTP Basic Auth.
     * @param string $baseUrl            Base URL of the WordPress REST API (e.g. https://yourdomain.com/wp-json).
     */
    public function __construct(
        private string $username = '',
        private string $applicationPassword = '',
        private string $baseUrl = 'https://yourdomain.com/wp-json',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has sufficient credentials to make requests.
     *
     * @return bool True if both username and application password are set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->username) && !empty($this->applicationPassword);
    }

    /**
     * List posts from the WordPress site.
     *
     * @param array $params Query parameters (e.g. per_page, page, search, status, author, categories, tags, order, orderby).
     * @return array The decoded JSON response containing the list of posts.
     */
    public function listPosts(array $params = []): array
    {
        return $this->request('GET', '/wp/v2/posts', $params);
    }

    /**
     * Get a single post by ID.
     *
     * @param int $id The post ID.
     * @return array The decoded JSON response for the post.
     */
    public function getPost(int $id): array
    {
        return $this->request('GET', '/wp/v2/posts/' . $id);
    }

    /**
     * Create a new post.
     *
     * @param array $data Post data (e.g. title, content, status, author, categories, tags, excerpt).
     * @return array The decoded JSON response for the created post.
     */
    public function createPost(array $data): array
    {
        return $this->request('POST', '/wp/v2/posts', $data);
    }

    /**
     * Update an existing post.
     *
     * @param int   $id   The post ID.
     * @param array $data Fields to update (e.g. title, content, status).
     * @return array The decoded JSON response for the updated post.
     */
    public function updatePost(int $id, array $data): array
    {
        return $this->request('PUT', '/wp/v2/posts/' . $id, $data);
    }

    /**
     * List pages from the WordPress site.
     *
     * @param array $params Query parameters (e.g. per_page, page, search, status, order, orderby).
     * @return array The decoded JSON response containing the list of pages.
     */
    public function listPages(array $params = []): array
    {
        return $this->request('GET', '/wp/v2/pages', $params);
    }

    /**
     * List users from the WordPress site.
     *
     * @param array $params Query parameters (e.g. per_page, page, search, roles).
     * @return array The decoded JSON response containing the list of users.
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/wp/v2/users', $params);
    }

    /**
     * List comments from the WordPress site.
     *
     * @param array $params Query parameters (e.g. per_page, page, post, status, author).
     * @return array The decoded JSON response containing the list of comments.
     */
    public function listComments(array $params = []): array
    {
        return $this->request('GET', '/wp/v2/comments', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array The decoded JSON response for the current user.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/wp/v2/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE).
     * @param string $path   API path relative to the base URL.
     * @param array  $data   Query parameters or request body.
     * @return array The decoded JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the WordPress REST API.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE).
     * @param string $path   API path relative to the base URL.
     * @param array  $data   Query parameters (GET) or request body (POST/PUT).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the service is not configured or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('WordPress integration is not configured. Provide username and application password.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth(
                $this->username,
                $this->applicationPassword,
            )->timeout(30);

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
                    Log::warning("WordPress API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("WordPress API returned HTML (HTTP {$response->status()}). The REST API endpoint may be disabled or the URL is incorrect.");
                }

                $error = $response->json('message') ?? $response->json('code') ?? $body;
                Log::error("WordPress API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("WordPress API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("WordPress API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to WordPress API: {$e->getMessage()}");
        }
    }
}
