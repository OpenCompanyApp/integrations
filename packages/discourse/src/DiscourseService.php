<?php

namespace OpenCompany\Integrations\Discourse;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Discourse API service for interacting with a Discourse forum instance.
 *
 * Handles authenticated HTTP requests to the Discourse API using
 * Api-Key and Api-Username headers. Supports reading and writing
 * topics, posts, and categories.
 */
class DiscourseService
{
    /**
     * Create a new DiscourseService instance.
     *
     * @param string $apiKey     The Discourse API key.
     * @param string $apiUsername The Discourse API username (must match the key owner).
     * @param string $hostname   The Discourse instance hostname (e.g., "discourse.example.com").
     */
    public function __construct(
        private string $apiKey = '',
        private string $apiUsername = '',
        private string $hostname = '',
    ) {
        $this->hostname = rtrim($this->hostname, '/');
    }

    /**
     * Check whether the service is configured with required credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->apiUsername) && !empty($this->hostname);
    }

    /**
     * List latest topics from the forum.
     *
     * @param int $page The page number (1-based).
     * @return array The parsed JSON response containing topic_list.
     */
    public function listTopics(int $page = 1): array
    {
        return $this->request('GET', '/latest.json', ['page' => $page]);
    }

    /**
     * Get a single topic by its ID.
     *
     * @param int $topicId The topic ID.
     * @return array The parsed JSON response containing topic details and posts.
     */
    public function getTopic(int $topicId): array
    {
        return $this->request('GET', "/t/{$topicId}.json");
    }

    /**
     * Create a new topic (which also creates the first post).
     *
     * @param string   $title      The topic title.
     * @param string   $raw        The raw body content (Markdown).
     * @param int      $category   The category ID to post in.
     * @param string[] $tags       Optional tags for the topic.
     * @return array The parsed JSON response from Discourse.
     */
    public function createTopic(string $title, string $raw, int $category, array $tags = []): array
    {
        $data = [
            'title' => $title,
            'raw' => $raw,
            'category' => $category,
        ];

        if (!empty($tags)) {
            $data['tags'] = $tags;
        }

        return $this->request('POST', '/posts.json', $data);
    }

    /**
     * Update an existing topic's metadata (title, category).
     *
     * @param int      $topicId   The topic ID to update.
     * @param string|null $title   The new title (optional).
     * @param int|null    $category The new category ID (optional).
     * @return array The parsed JSON response from Discourse.
     */
    public function updateTopic(int $topicId, ?string $title = null, ?int $category = null): array
    {
        $data = [];
        if ($title !== null) {
            $data['title'] = $title;
        }
        if ($category !== null) {
            $data['category_id'] = $category;
        }

        return $this->request('PUT', "/t/{$topicId}.json", $data);
    }

    /**
     * List all categories on the forum.
     *
     * @return array The parsed JSON response containing category_list.
     */
    public function listCategories(): array
    {
        return $this->request('GET', '/categories.json');
    }

    /**
     * Get a single category by its ID, including topic lists.
     *
     * @param int $categoryId The category ID.
     * @return array The parsed JSON response containing topic_list and category details.
     */
    public function getCategory(int $categoryId): array
    {
        return $this->request('GET', "/c/{$categoryId}.json");
    }

    /**
     * Create a new post as a reply to an existing topic.
     *
     * @param int    $topicId The topic ID to reply to.
     * @param string $raw     The raw body content (Markdown).
     * @return array The parsed JSON response from Discourse.
     */
    public function createPost(int $topicId, string $raw): array
    {
        return $this->request('POST', '/posts.json', [
            'topic_id' => $topicId,
            'raw' => $raw,
        ]);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * Used primarily to verify that the API credentials are valid.
     *
     * @return array The parsed JSON response containing the current user.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/session/current.json');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param string $path   The API path (e.g., "/latest.json").
     * @param array  $data   Query parameters (GET) or body data (POST/PUT).
     * @return array The parsed JSON response, or empty array on null.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Discourse API.
     *
     * Sends authenticated requests using Api-Key and Api-Username headers.
     * Handles error responses and connection failures with descriptive exceptions.
     *
     * @param string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param string $path   The API path (e.g., "/latest.json").
     * @param array  $data   Query parameters (GET) or body data (POST/PUT).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     * @throws \RuntimeException If credentials are missing, the request fails, or the server is unreachable.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->apiUsername || !$this->hostname) {
            throw new \RuntimeException('Discourse integration is not configured. API key, username, and hostname are required.');
        }

        $url = 'https://' . $this->hostname . $path;

        try {
            $http = Http::withHeaders([
                'Api-Key' => $this->apiKey,
                'Api-Username' => $this->apiUsername,
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
                    Log::warning("Discourse API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Discourse API endpoint not available (HTTP {$response->status()}). Check the hostname and API path.");
                }

                $error = $response->json('errors') ?? $response->json('error') ?? $body;
                if (is_array($error)) {
                    $error = implode('; ', $error);
                }
                Log::error("Discourse API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Discourse API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Discourse API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Discourse API at {$this->hostname}: {$e->getMessage()}");
        }
    }
}
