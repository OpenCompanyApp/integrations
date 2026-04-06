<?php

namespace OpenCompany\Integrations\Facebook;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacebookService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://graph.facebook.com/v21.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all Facebook Pages the current user manages.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. fields, limit).
     * @return array<string, mixed>
     */
    public function listPages(array $params = []): array
    {
        return $this->request('GET', '/me/accounts', $params);
    }

    /**
     * Get details for a single Facebook Page.
     *
     * @param  string  $pageId  The Facebook Page ID.
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. fields).
     * @return array<string, mixed>
     */
    public function getPage(string $pageId, array $params = []): array
    {
        return $this->request('GET', '/' . urlencode($pageId), $params);
    }

    /**
     * List posts published by a Facebook Page.
     *
     * @param  string  $pageId  The Facebook Page ID.
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. fields, limit, since, until).
     * @return array<string, mixed>
     */
    public function listPosts(string $pageId, array $params = []): array
    {
        return $this->request('GET', '/' . urlencode($pageId) . '/posts', $params);
    }

    /**
     * Create (publish) a post on a Facebook Page.
     *
     * @param  string  $pageId  The Facebook Page ID.
     * @param  string  $message  The post body text.
     * @param  array<string, mixed>  $params  Additional parameters (e.g. link, scheduled_publish_time).
     * @return array<string, mixed>
     */
    public function createPost(string $pageId, string $message, array $params = []): array
    {
        $params['message'] = $message;

        return $this->request('POST', '/' . urlencode($pageId) . '/feed', $params);
    }

    /**
     * Get details for a single post.
     *
     * @param  string  $postId  The Facebook Post ID.
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. fields).
     * @return array<string, mixed>
     */
    public function getPost(string $postId, array $params = []): array
    {
        return $this->request('GET', '/' . urlencode($postId), $params);
    }

    /**
     * List insights (metrics) for a Facebook Page.
     *
     * @param  string  $pageId  The Facebook Page ID.
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. metric, period, since, until).
     * @return array<string, mixed>
     */
    public function listInsights(string $pageId, array $params = []): array
    {
        return $this->request('GET', '/' . urlencode($pageId) . '/insights', $params);
    }

    /**
     * Get the current user's profile information.
     *
     * @param  array<string, mixed>  $params  Optional query parameters (e.g. fields).
     * @return array<string, mixed>
     */
    public function getCurrentUser(array $params = []): array
    {
        return $this->request('GET', '/me', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/me/accounts").
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Facebook Graph API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query or body parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Facebook access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
            ])->timeout(30);

            // Always include the access token as a query parameter for Facebook Graph API
            $data['access_token'] = $this->accessToken;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['error']['message'] ?? $response->body();

                Log::error("Facebook API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Facebook API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Facebook API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Facebook API: {$e->getMessage()}");
        }
    }
}
