<?php

namespace OpenCompany\Integrations\Linkedin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the LinkedIn REST API v2 covering posts, organizations, and ad accounts.
 *
 * Wraps the LinkedIn Marketing API with Bearer token authentication, request routing, and error reporting.
 */
class LinkedinService
{
    /**
     * @param  string  $accessToken  LinkedIn OAuth 2.0 access token
     * @param  string  $baseUrl      LinkedIn API base URL (default: https://api.linkedin.com/v2)
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.linkedin.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Posts ──────────────────────────────────────────────

    /**
     * List posts (UGC posts) for an author.
     *
     * @param  array<string, mixed>  $params  Query params: author, count, start
     * @return array<string, mixed>
     */
    public function listPosts(array $params = []): array
    {
        return $this->request('GET', '/ugcPosts', $params);
    }

    /**
     * Get a post by ID.
     *
     * @return array<string, mixed>
     */
    public function getPost(string $id): array
    {
        return $this->request('GET', "/ugcPosts/{$id}");
    }

    /**
     * Create a new UGC post.
     *
     * @param  array<string, mixed>  $data  Post payload
     * @return array<string, mixed>
     */
    public function createPost(array $data): array
    {
        return $this->request('POST', '/ugcPosts', $data);
    }

    // ── Organizations ─────────────────────────────────────

    /**
     * List organizations (company pages).
     *
     * @param  array<string, mixed>  $params  Query params
     * @return array<string, mixed>
     */
    public function listOrganizations(array $params = []): array
    {
        return $this->request('GET', '/organizationalEntityAcls', $params);
    }

    /**
     * Get an organization by ID.
     *
     * @return array<string, mixed>
     */
    public function getOrganization(string $id): array
    {
        return $this->request('GET', "/organizations/{$id}");
    }

    // ── Ad Accounts ───────────────────────────────────────

    /**
     * List ad accounts.
     *
     * @param  array<string, mixed>  $params  Query params
     * @return array<string, mixed>
     */
    public function listAdAccounts(array $params = []): array
    {
        return $this->request('GET', '/adAccounts', $params);
    }

    // ── Me (current user) ─────────────────────────────────

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getMe(): array
    {
        return $this->request('GET', '/me');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PUT/DELETE)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('LinkedIn access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['message'] ?? $body['error_description'] ?? $body['error'] ?? $response->body();

                Log::error("LinkedIn API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => is_string($err) ? $err : json_encode($err),
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('LinkedIn API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("LinkedIn API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to LinkedIn API: {$e->getMessage()}");
        }
    }
}
