<?php

namespace OpenCompany\Integrations\Tapfiliate;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TapfiliateService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.tapfiliate.com/1.5',
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
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * List affiliates with optional pagination.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listAffiliates(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/affiliates', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single affiliate by ID.
     *
     * @return array<string, mixed>
     */
    public function getAffiliate(string $id): array
    {
        return $this->request('GET', '/affiliates/' . urlencode($id));
    }

    /**
     * List conversions with optional filters and pagination.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listConversions(array $filters = []): array
    {
        return $this->request('GET', '/conversions', $filters);
    }

    /**
     * Create a new conversion.
     *
     * @return array<string, mixed>
     */
    public function createConversion(string $affiliateId, float $amount, string $externalId, array $options = []): array
    {
        $data = array_merge([
            'affiliate_id' => $affiliateId,
            'amount' => $amount,
            'external_id' => $externalId,
        ], $options);

        return $this->request('POST', '/conversions', $data);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Tapfiliate API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Tapfiliate API key is not configured.');
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
                    Log::warning("Tapfiliate API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Tapfiliate API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be experiencing issues.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Tapfiliate API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Tapfiliate API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Tapfiliate API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Tapfiliate API: {$e->getMessage()}");
        }
    }
}
