<?php

namespace OpenCompany\Integrations\Ghost;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GhostService
{
    /**
     * @param  string  $apiKey  Ghost Admin API key (id:secret format)
     * @param  string  $baseUrl  Ghost API base URL (e.g. https://mysite.ghost.io/ghost/api/admin)
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Ghost integration is configured with an API key and base URL.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) && ! empty($this->baseUrl);
    }

    /**
     * List posts with optional filtering, pagination, and ordering.
     *
     * @param  array<string, mixed>  $params  Query parameters (filter, page, limit, order, fields, include, etc.)
     * @return array<string, mixed>
     */
    public function listPosts(array $params = []): array
    {
        return $this->request('GET', '/posts', $params);
    }

    /**
     * Get a single post by ID.
     *
     * @param  string  $id  Post UUID
     * @param  array<string, mixed>  $params  Optional query parameters (fields, include, formats)
     * @return array<string, mixed>
     */
    public function getPost(string $id, array $params = []): array
    {
        return $this->request('GET', '/posts/' . urlencode($id), $params);
    }

    /**
     * Create a new post.
     *
     * @param  array<string, mixed>  $data  Post data (title, html, plaintext, feature_image, featured, status, tags, authors, etc.)
     * @return array<string, mixed>
     */
    public function createPost(array $data): array
    {
        return $this->request('POST', '/posts', [], ['posts' => [$data]]);
    }

    /**
     * Update an existing post.
     *
     * @param  string  $id  Post UUID
     * @param  array<string, mixed>  $data  Fields to update (title, html, featured, status, tags, etc.)
     * @return array<string, mixed>
     */
    public function updatePost(string $id, array $data): array
    {
        return $this->request('PUT', '/posts/' . urlencode($id), [], ['posts' => [$data]]);
    }

    /**
     * List pages with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (filter, page, limit, order, fields, include, etc.)
     * @return array<string, mixed>
     */
    public function listPages(array $params = []): array
    {
        return $this->request('GET', '/pages', $params);
    }

    /**
     * List members with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (filter, page, limit, order, fields, include, etc.)
     * @return array<string, mixed>
     */
    public function listMembers(array $params = []): array
    {
        return $this->request('GET', '/members', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Generate a Ghost Admin API JWT token from the API key.
     *
     * Ghost Admin API keys are in the format `{id}:{secret}`. The JWT is created
     * using the key ID as the payload and the secret for HMAC-SHA256 signing.
     *
     * @param  int  $exp  Token expiration in seconds from now (default: 5 minutes)
     * @return string
     */
    private function generateToken(int $exp = 300): string
    {
        $parts = explode(':', $this->apiKey);
        if (count($parts) !== 2) {
            throw new \RuntimeException('Invalid Ghost API key format. Expected "id:secret".');
        }

        [$id, $secret] = $parts;

        // Decode the hex secret to raw bytes
        $secretDecoded = hex2bin($secret);
        if ($secretDecoded === false) {
            throw new \RuntimeException('Invalid Ghost API key secret — not valid hex.');
        }

        $now = time();
        $header = $this->base64UrlEncode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = $this->base64UrlEncode(json_encode([
            'iat' => $now,
            'exp' => $now + $exp,
            'aud' => '/admin/',
        ]));

        $signature = $this->base64UrlEncode(
            hash_hmac('sha256', "{$header}.{$payload}", $secretDecoded, true)
        );

        return "{$header}.{$payload}.{$signature}";
    }

    /**
     * Base64URL-encode a string (JWT-safe, no padding).
     */
    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API endpoint path (e.g. /posts, /pages)
     * @param  array<string, mixed>  $query  Query string parameters
     * @param  array<string, mixed>|null  $body  JSON body for POST/PUT requests
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], ?array $body = null): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Ghost Admin API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $query  Query string parameters
     * @param  array<string, mixed>|null  $body  JSON body for POST/PUT requests
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], ?array $body = null): \Illuminate\Http\Client\Response
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Ghost integration is not configured. Provide an API key and base URL.');
        }

        $url = $this->baseUrl . $path;
        $token = $this->generateToken();

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Ghost ' . $token,
                'Content-Type' => 'application/json',
                'Accept-Version' => 'v5.0',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($url, $body ?? []),
                'PUT' => $http->put($url, $body ?? []),
                'DELETE' => $http->delete($url, $body ?? []),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('errors.0.message') ?? $response->body();
                Log::error("Ghost API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Ghost API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Ghost API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Ghost API: {$e->getMessage()}");
        }
    }
}
