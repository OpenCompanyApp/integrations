<?php

namespace OpenCompany\Integrations\LinkedIn;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * LinkedIn API service for interacting with the LinkedIn v2 REST API.
 *
 * Handles authentication via Bearer tokens and provides methods for
 * profile management, connections, organization lookup, and post creation.
 */
class LinkedInService
{
    /**
     * Create a new LinkedInService instance.
     *
     * @param  string  $accessToken  The OAuth2 access token for LinkedIn API authentication.
     * @param  string  $baseUrl  The base URL for the LinkedIn API (default: https://api.linkedin.com/v2).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.linkedin.com/v2',
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
     * Get the authenticated user's LinkedIn profile.
     *
     * @return array<string, mixed> The profile data including id, localizedFirstName, localizedLastName, etc.
     */
    public function getProfile(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * Get the authenticated user's basic profile information.
     *
     * Alias for getProfile() — returns the current user's LinkedIn identity.
     *
     * @return array<string, mixed> The current user's profile data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * List the authenticated user's 1st-degree connections.
     *
     * @return array<string, mixed> Paginated list of connections.
     */
    public function listConnections(): array
    {
        return $this->request('GET', '/connections');
    }

    /**
     * Create a post on behalf of the authenticated user.
     *
     * @param  array<string, mixed>  $postBody  The UGC post payload following LinkedIn's UGC Posts API format.
     * @return array<string, mixed> The created post response data.
     */
    public function createPost(array $postBody): array
    {
        return $this->request('POST', '/ugcPosts', $postBody);
    }

    /**
     * Get an organization's details by its LinkedIn organization ID.
     *
     * @param  string  $organizationId  The LinkedIn organization URN ID (e.g., "2414183").
     * @return array<string, mixed> The organization data including id, localizedName, etc.
     */
    public function getOrganization(string $organizationId): array
    {
        return $this->request('GET', '/organizations/' . urlencode($organizationId));
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to base URL.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST/PUT).
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the LinkedIn API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to base URL.
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST/PUT).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('LinkedIn access token is not configured.');
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("LinkedIn API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("LinkedIn API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("LinkedIn API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("LinkedIn API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("LinkedIn API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to LinkedIn API: {$e->getMessage()}");
        }
    }
}
