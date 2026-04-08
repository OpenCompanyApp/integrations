<?php

namespace OpenCompany\Integrations\Drip;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DripService
{
    public function __construct(
        private string $apiKey = '',
        private string $accountId = '',
        private string $baseUrl = 'https://api.getdrip.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Drip integration is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->accountId);
    }

    /**
     * Get the configured Drip account ID.
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * Fetch a single campaign by ID.
     *
     * @return array<string, mixed>
     */
    public function getCampaign(string $id): array
    {
        return $this->request('GET', "/v2/{$this->accountId}/campaigns/{$id}");
    }

    /**
     * List subscribers for the configured account.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Results per page (max 1000).
     * @return array<string, mixed>
     */
    public function listSubscribers(int $page = 1, int $perPage = 100): array
    {
        return $this->request('GET', "/v2/{$this->accountId}/subscribers", [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Fetch a single subscriber by ID or email.
     *
     * @param  string  $id  Subscriber ID or email address.
     * @return array<string, mixed>
     */
    public function getSubscriber(string $id): array
    {
        return $this->request('GET', "/v2/subscribers/{$id}");
    }

    /**
     * Create or update a subscriber.
     *
     * @param  string  $email  The subscriber's email address.
     * @param  array<string, mixed> $options  Additional fields (first_name, last_name, custom_fields, tags, etc.).
     * @return array<string, mixed>
     */
    public function createSubscriber(string $email, array $options = []): array
    {
        $payload = array_merge(['email' => $email], $options);

        return $this->request('POST', '/v2/subscribers', [
            'subscribers' => [$payload],
        ]);
    }

    /**
     * List campaigns for the configured account.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Results per page (max 1000).
     * @return array<string, mixed>
     */
    public function listCampaigns(int $page = 1, int $perPage = 100): array
    {
        return $this->request('GET', "/v2/{$this->accountId}/campaigns", [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * List workflows for the configured account.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $perPage  Results per page (max 1000).
     * @return array<string, mixed>
     */
    public function listWorkflows(int $page = 1, int $perPage = 100): array
    {
        return $this->request('GET', "/v2/{$this->accountId}/workflows", [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Fetch a single workflow by ID.
     *
     * @return array<string, mixed>
     */
    public function getWorkflow(string $id): array
    {
        return $this->request('GET', "/v2/{$this->accountId}/workflows/{$id}");
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/user');
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
     * Make a raw HTTP request to the Drip API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Drip API key is not configured.');
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
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Drip API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Drip API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Drip API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Drip API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Drip API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Drip API: {$e->getMessage()}");
        }
    }
}
