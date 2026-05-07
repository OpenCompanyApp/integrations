<?php

namespace OpenCompany\Integrations\Beamer;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Beamer REST API.
 *
 * Handles Beamer-Api-Key authentication, JSON dispatch, and error
 * normalization for typed and generic Beamer endpoints.
 */
class BeamerService
{
    /**
     * @param  string  $apiKey  Beamer API key sent in the Beamer-Api-Key header.
     * @param  string  $baseUrl  Base URL for the Beamer API.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.getbeamer.com/v0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Beamer service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List posts from Beamer.
     *
     * @param  int|null  $limit   Maximum number of posts to return (default: 10, max: 100).
     * @param  int|null  $page    Page number for pagination (default: 1).
     * @param  string|null  $status  Filter by status: "published", "draft", or "scheduled".
     * @return array<string, mixed>
     */
    public function listPosts(?int $limit = null, ?int $page = null, ?string $status = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($page !== null) {
            $params['page'] = $page;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/posts', $params);
    }

    /**
     * Get a single post by its ID.
     *
     * @param  int|string  $id  The post ID.
     * @return array<string, mixed>
     */
    public function getPost(int|string $id): array
    {
        return $this->request('GET', '/posts/' . urlencode((string) $id));
    }

    /**
     * Create a new post in Beamer.
     *
     * @param  string  $title     The post title.
     * @param  string  $content   The post body content (HTML supported).
     * @param  int|string|null  $category  The category ID to assign.
     * @param  string|null  $date     Publication date (ISO 8601, e.g. "2025-06-01T12:00:00Z").
     * @return array<string, mixed>
     */
    public function createPost(string $title, string $content, int|string|null $category = null, ?string $date = null): array
    {
        $data = [
            'title' => $title,
            'content' => $content,
        ];

        if ($category !== null) {
            $data['category'] = $category;
        }
        if ($date !== null) {
            $data['date'] = $date;
        }

        return $this->request('POST', '/posts', $data);
    }

    /**
     * List comments for a specific post.
     *
     * @param  int|string  $postId  The post ID.
     * @return array<string, mixed>
     */
    public function listComments(int|string $postId): array
    {
        return $this->request('GET', '/posts/' . urlencode((string) $postId) . '/comments');
    }

    /**
     * Get the currently authenticated Beamer user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * List all categories in Beamer.
     *
     * @return array<string, mixed>
     */
    public function listCategories(): array
    {
        return $this->request('GET', '/categories');
    }

    /**
     * Call any Beamer GET API endpoint.
     *
     * @param  string  $path  API path relative to the v0 base URL.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Call any Beamer POST API endpoint.
     *
     * @param  string  $path  API path relative to the v0 base URL.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $body);
    }

    /**
     * Call any Beamer PUT API endpoint.
     *
     * @param  string  $path  API path relative to the v0 base URL.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $body);
    }

    /**
     * Call any Beamer DELETE API endpoint.
     *
     * @param  string  $path  API path relative to the v0 base URL.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/posts").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Beamer API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Beamer API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Beamer-Api-Key' => $this->apiKey,
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
                    Log::warning("Beamer API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Beamer API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Beamer API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Beamer API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Beamer API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Beamer API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize a generic API path.
     */
    private function normalizePath(string $path): string
    {
        return '/'.ltrim($path, '/');
    }
}
