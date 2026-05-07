<?php

namespace OpenCompany\Integrations\CampaignMonitor;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Campaign Monitor API v3.3.
 *
 * Handles API-key Basic authentication, response parsing, error normalization,
 * and safe relative endpoint access for all Campaign Monitor tools.
 */
class CampaignMonitorService
{
    /**
     * @param  string  $apiKey  Campaign Monitor API key.
     * @param  string  $baseUrl  Base URL for the Campaign Monitor API.
     */
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
        return $this->apiKey !== '';
    }

    /**
     * List clients visible to the authenticated account.
     *
     * @return array<string, mixed>
     */
    public function listClients(): array
    {
        return $this->apiGet('/clients.json');
    }

    /**
     * List sent campaigns across the account.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCampaigns(array $params = []): array
    {
        return $this->apiGet('/campaigns.json', $params);
    }

    /**
     * Get details for a specific campaign.
     *
     * @return array<string, mixed>
     */
    public function getCampaign(string $campaignId): array
    {
        return $this->apiGet('/campaigns/' . rawurlencode($campaignId) . '.json');
    }

    /**
     * List subscriber lists for a client or the authenticated account.
     *
     * @param  string|null  $clientId  Optional client ID.
     * @return array<string, mixed>
     */
    public function listLists(?string $clientId = null): array
    {
        if ($clientId !== null && $clientId !== '') {
            return $this->apiGet('/clients/' . rawurlencode($clientId) . '/lists.json');
        }

        return $this->apiGet('/lists.json');
    }

    /**
     * Get details for a specific subscriber list.
     *
     * @return array<string, mixed>
     */
    public function getList(string $listId): array
    {
        return $this->apiGet('/lists/' . rawurlencode($listId) . '.json');
    }

    /**
     * List active subscribers on a list.
     *
     * @param  string  $listId  Subscriber list ID.
     * @param  int  $page  Page number for pagination.
     * @param  int  $pageSize  Number of subscribers per page.
     * @return array<string, mixed>
     */
    public function listSubscribers(string $listId, int $page = 1, int $pageSize = 100): array
    {
        return $this->apiGet('/lists/' . rawurlencode($listId) . '/active.json', [
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }

    /**
     * Add or update a subscriber on a list.
     *
     * @param  string  $listId  Subscriber list ID.
     * @param  string  $email  Subscriber email address.
     * @param  string  $name  Subscriber full name.
     * @param  bool  $resubscribe  Whether to reactivate a previously unsubscribed subscriber.
     * @return array<string, mixed>
     */
    public function addSubscriber(string $listId, string $email, string $name, bool $resubscribe = true): array
    {
        return $this->apiPost('/subscribers/' . rawurlencode($listId) . '.json', [
            'EmailAddress' => $email,
            'Name' => $name,
            'Resubscribe' => $resubscribe,
        ]);
    }

    /**
     * Get the primary contact for the account.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/primarycontact.json');
    }

    /**
     * Execute a safe relative GET request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Execute a safe relative POST request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $query, $body);
    }

    /**
     * Execute a safe relative PUT request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, $query, $body);
    }

    /**
     * Execute a safe relative DELETE request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = [], array $query = []): array
    {
        return $this->request('DELETE', $path, $query, $body);
    }

    /**
     * Execute a request and parse the JSON response.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if (trim($response->body()) === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        return $response->json() ?? [];
    }

    /**
     * Execute an authenticated raw HTTP request.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Campaign Monitor API key is not configured.');
        }

        $url = $this->url($this->safePath($path), $query);

        try {
            $http = Http::withBasicAuth($this->apiKey, '')
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Campaign Monitor API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Campaign Monitor API: {$e->getMessage()}");
        }
    }

    /**
     * Validate and normalize a relative API path.
     */
    private function safePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || preg_match('#^[a-z][a-z0-9+.-]*://#i', $path) || str_starts_with($path, '//') || str_contains($path, '..')) {
            throw new \InvalidArgumentException('Path must be a safe relative Campaign Monitor API path.');
        }

        return '/' . ltrim($path, '/');
    }

    /**
     * Build the absolute request URL.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function url(string $path, array $query = []): string
    {
        $query = array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');

        if ($query === []) {
            return $this->baseUrl . $path;
        }

        return $this->baseUrl . $path . '?' . http_build_query($query);
    }

    /**
     * Parse and throw a normalized API error.
     *
     * @throws \RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type') ?? '';
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Campaign Monitor API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new \RuntimeException("Campaign Monitor API returned unexpected HTML (HTTP {$response->status()}).");
        }

        $error = $response->json('Message') ?? $response->json('message') ?? $response->json('error') ?? $body;

        Log::error("Campaign Monitor API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new \RuntimeException("Campaign Monitor API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
