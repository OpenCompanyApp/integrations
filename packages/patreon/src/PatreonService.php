<?php

namespace OpenCompany\Integrations\Patreon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PatreonService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://www.patreon.com/api/oauth2/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all campaigns for the authenticated user.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listCampaigns(array $params = []): array
    {
        return $this->request('GET', '/campaigns', $params);
    }

    /**
     * Get a single campaign by ID.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getCampaign(string $campaignId, array $params = []): array
    {
        return $this->request('GET', '/campaigns/' . urlencode($campaignId), $params);
    }

    /**
     * List members for a campaign.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listMembers(string $campaignId, array $params = []): array
    {
        return $this->request('GET', '/campaigns/' . urlencode($campaignId) . '/members', $params);
    }

    /**
     * Get a single member by ID.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getMember(string $memberId, array $params = []): array
    {
        return $this->request('GET', '/members/' . urlencode($memberId), $params);
    }

    /**
     * List posts for a campaign.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listPosts(string $campaignId, array $params = []): array
    {
        return $this->request('GET', '/campaigns/' . urlencode($campaignId) . '/posts', $params);
    }

    /**
     * Get a single post by ID.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getPost(string $postId, array $params = []): array
    {
        return $this->request('GET', '/posts/' . urlencode($postId), $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getCurrentUser(array $params = []): array
    {
        return $this->request('GET', '/identity', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Patreon API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Patreon access token is not configured.');
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
                    Log::warning("Patreon API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Patreon API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Patreon API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Patreon API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Patreon API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Patreon API: {$e->getMessage()}");
        }
    }
}
