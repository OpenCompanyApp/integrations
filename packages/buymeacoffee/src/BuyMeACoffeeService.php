<?php

namespace OpenCompany\Integrations\BuyMeACoffee;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BuyMeACoffeeService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://developers.buymeacoffee.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    public function listSupporters(array $params = []): array
    {
        return $this->request('GET', '/supporters', $params);
    }

    public function getSupporter(string $supporterId): array
    {
        return $this->request('GET', '/supporters/' . urlencode($supporterId));
    }

    public function listSubscriptions(array $params = []): array
    {
        return $this->request('GET', '/subscriptions', $params);
    }

    public function listExtras(array $params = []): array
    {
        return $this->request('GET', '/extras', $params);
    }

    public function getExtra(string $extraId): array
    {
        return $this->request('GET', '/extras/' . urlencode($extraId));
    }

    public function listShops(array $params = []): array
    {
        return $this->request('GET', '/shops', $params);
    }

    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Buy Me a Coffee access token is not configured.');
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
                    Log::warning("Buy Me a Coffee API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Buy Me a Coffee API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Buy Me a Coffee API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Buy Me a Coffee API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Buy Me a Coffee API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Buy Me a Coffee API: {$e->getMessage()}");
        }
    }
}
