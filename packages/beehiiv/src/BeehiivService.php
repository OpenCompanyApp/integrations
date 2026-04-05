<?php

namespace OpenCompany\Integrations\Beehiiv;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the Beehiiv API v2.
 *
 * Handles authentication via Bearer token and provides methods for all
 * Beehiiv API endpoints including posts, subscribers, and stats.
 */
class BeehiivService
{
    /**
     * Create a new BeehiivService instance.
     *
     * @param  string  $apiKey  The Beehiiv API key for Bearer token authentication.
     * @param  string  $publicationId  The Beehiiv publication ID.
     * @param  string  $baseUrl  The Beehiiv API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $publicationId = '',
        private string $baseUrl = 'https://api.beehiiv.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->publicationId);
    }

    /**
     * Get the configured publication ID.
     */
    public function getPublicationId(): string
    {
        return $this->publicationId;
    }

    /**
     * List publications (used for connection testing).
     *
     * @return array<string, mixed>
     */
    public function listPublications(): array
    {
        return $this->request('GET', '/publications');
    }

    /**
     * List posts for the configured publication.
     *
     * @param  array<string, mixed>  $params  Query parameters (status, limit, page, etc.).
     * @return array<string, mixed>
     */
    public function listPosts(array $params = []): array
    {
        return $this->request('GET', "/publications/{$this->publicationId}/posts", $params);
    }

    /**
     * Get a single post by ID.
     *
     * @return array<string, mixed>
     */
    public function getPost(string $postId): array
    {
        return $this->request('GET', "/publications/{$this->publicationId}/posts/{$postId}");
    }

    /**
     * Create a new post.
     *
     * @param  array<string, mixed>  $data  Post data (title, content, status, etc.).
     * @return array<string, mixed>
     */
    public function createPost(array $data): array
    {
        return $this->request('POST', "/publications/{$this->publicationId}/posts", $data);
    }

    /**
     * Update an existing post.
     *
     * @param  array<string, mixed>  $data  Fields to update.
     * @return array<string, mixed>
     */
    public function updatePost(string $postId, array $data): array
    {
        return $this->request('PATCH', "/publications/{$this->publicationId}/posts/{$postId}", $data);
    }

    /**
     * Delete a post.
     *
     * @return array<string, mixed>
     */
    public function deletePost(string $postId): array
    {
        return $this->request('DELETE', "/publications/{$this->publicationId}/posts/{$postId}");
    }

    /**
     * List subscribers for the configured publication.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, page, status, etc.).
     * @return array<string, mixed>
     */
    public function listSubscribers(array $params = []): array
    {
        return $this->request('GET', "/publications/{$this->publicationId}/subscriptions", $params);
    }

    /**
     * Get a single subscriber by subscription ID.
     *
     * @return array<string, mixed>
     */
    public function getSubscriber(string $subscriptionId): array
    {
        return $this->request('GET', "/publications/{$this->publicationId}/subscriptions/{$subscriptionId}");
    }

    /**
     * Create a new subscriber.
     *
     * @param  array<string, mixed>  $data  Subscriber data (email, reactivate_existing, etc.).
     * @return array<string, mixed>
     */
    public function createSubscriber(array $data): array
    {
        return $this->request('POST', "/publications/{$this->publicationId}/subscriptions", $data);
    }

    /**
     * Get publication stats.
     *
     * @param  array<string, mixed>  $params  Query parameters (intent, etc.).
     * @return array<string, mixed>
     */
    public function getStats(array $params = []): array
    {
        return $this->request('GET', "/publications/{$this->publicationId}/stats", $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST/PATCH/DELETE).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Beehiiv API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Beehiiv API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("Beehiiv API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Beehiiv API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Beehiiv API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Beehiiv API: {$e->getMessage()}");
        }
    }
}
