<?php

namespace OpenCompany\Integrations\Zend;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZendService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.zendesk.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all email marketing campaigns.
     *
     * @return array<string, mixed>
     */
    public function listCampaigns(): array
    {
        return $this->request('GET', '/campaigns');
    }

    /**
     * Get details for a specific campaign.
     *
     * @return array<string, mixed>
     */
    public function getCampaign(string $campaignId): array
    {
        return $this->request('GET', '/campaigns/' . urlencode($campaignId));
    }

    /**
     * Create a new email marketing campaign.
     *
     * @param  array<string, mixed>  $data  Campaign data (subject, content, list_ids, etc.).
     * @return array<string, mixed>
     */
    public function createCampaign(array $data): array
    {
        return $this->request('POST', '/campaigns', $data);
    }

    /**
     * List all subscriber lists.
     *
     * @return array<string, mixed>
     */
    public function listLists(): array
    {
        return $this->request('GET', '/lists');
    }

    /**
     * Get details for a specific subscriber list.
     *
     * @return array<string, mixed>
     */
    public function getList(string $listId): array
    {
        return $this->request('GET', '/lists/' . urlencode($listId));
    }

    /**
     * List subscribers, optionally filtered by list.
     *
     * @param  string|null  $listId  Optional list ID to filter subscribers.
     * @param  int  $page  Page number for pagination (1-based).
     * @param  int  $pageSize  Number of subscribers per page.
     * @return array<string, mixed>
     */
    public function listSubscribers(?string $listId = null, int $page = 1, int $pageSize = 100): array
    {
        $path = $listId
            ? '/lists/' . urlencode($listId) . '/subscribers'
            : '/subscribers';

        return $this->request('GET', $path, [
            'page' => $page,
            'page_size' => $pageSize,
        ]);
    }

    /**
     * Get details for a specific subscriber.
     *
     * @return array<string, mixed>
     */
    public function getSubscriber(string $subscriberId): array
    {
        return $this->request('GET', '/subscribers/' . urlencode($subscriberId));
    }

    /**
     * Get the authenticated user's account details.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
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
     * Make a raw HTTP request to the Zendesk API using Bearer token auth.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Zendesk access token is not configured.');
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
                    Log::warning("Zendesk API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Zendesk API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Zendesk API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Zendesk API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zendesk API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zendesk API: {$e->getMessage()}");
        }
    }
}
