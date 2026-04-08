<?php

namespace OpenCompany\Integrations\CampaignMonitor;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CampaignMonitorService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.createsend.com/api/v3.3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List all campaigns sent from the account.
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
     * List all subscriber lists in the account.
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
     * List active subscribers on a list.
     *
     * @param  string  $listId  The list ID.
     * @param  int  $page  Page number for pagination (1-based).
     * @param  int  $pageSize  Number of subscribers per page.
     * @return array<string, mixed>
     */
    public function listSubscribers(string $listId, int $page = 1, int $pageSize = 100): array
    {
        return $this->request('GET', '/lists/' . urlencode($listId) . '/active', [
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }

    /**
     * Add a subscriber to a list.
     *
     * @param  string  $listId  The list ID.
     * @param  string  $email  Subscriber email address.
     * @param  string  $name  Subscriber full name.
     * @param  bool  $resubscribe  Re-subscribe if previously unsubscribed.
     * @return array<string, mixed>
     */
    public function addSubscriber(string $listId, string $email, string $name, bool $resubscribe = true): array
    {
        return $this->request('POST', '/lists/' . urlencode($listId) . '/subscribers', [
            'EmailAddress' => $email,
            'Name' => $name,
            'Resubscribe' => $resubscribe,
        ]);
    }

    /**
     * Get the primary contact (current user) for the account.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/primarycontact');
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
     * Make a raw HTTP request to the Campaign Monitor API using Basic auth.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Campaign Monitor API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, '')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

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
                    Log::warning("Campaign Monitor API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Campaign Monitor API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('Message') ?? $response->json('error') ?? $body;
                Log::error("Campaign Monitor API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Campaign Monitor API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Campaign Monitor API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Campaign Monitor API: {$e->getMessage()}");
        }
    }
}
