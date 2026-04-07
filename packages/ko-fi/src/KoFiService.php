<?php

namespace OpenCompany\Integrations\KoFi;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KoFiService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://ko-fi.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List supporters.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listSupporters(array $params = []): array
    {
        return $this->request('GET', '/supporters', $params);
    }

    /**
     * Get a single supporter by email.
     *
     * @return array<string, mixed>
     */
    public function getSupporter(string $email): array
    {
        return $this->request('GET', '/supporters/' . urlencode($email));
    }

    /**
     * List transactions.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listTransactions(array $params = []): array
    {
        return $this->request('GET', '/transactions', $params);
    }

    /**
     * List commissions.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listCommissions(array $params = []): array
    {
        return $this->request('GET', '/commissions', $params);
    }

    /**
     * Get a single commission by ID.
     *
     * @return array<string, mixed>
     */
    public function getCommission(string $commissionId): array
    {
        return $this->request('GET', '/commissions/' . urlencode($commissionId));
    }

    /**
     * List shop items.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listShopItems(array $params = []): array
    {
        return $this->request('GET', '/shop/items', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
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
     * Make a raw HTTP request to the Ko-fi API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Ko-fi access token is not configured.');
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
                    Log::warning("Ko-fi API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Ko-fi API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Ko-fi API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Ko-fi API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Ko-fi API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Ko-fi API: {$e->getMessage()}");
        }
    }
}
