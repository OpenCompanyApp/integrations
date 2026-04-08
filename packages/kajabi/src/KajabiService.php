<?php

namespace OpenCompany\Integrations\Kajabi;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KajabiService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://app.kajabi.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    public function listOffers(array $params = []): array
    {
        return $this->request('GET', '/offers', $params);
    }

    public function getOffer(string $offerId): array
    {
        return $this->request('GET', '/offers/' . urlencode($offerId));
    }

    public function listProducts(array $params = []): array
    {
        return $this->request('GET', '/products', $params);
    }

    public function getProduct(string $productId): array
    {
        return $this->request('GET', '/products/' . urlencode($productId));
    }

    public function listMembers(array $params = []): array
    {
        return $this->request('GET', '/members', $params);
    }

    public function getMember(string $memberId): array
    {
        return $this->request('GET', '/members/' . urlencode($memberId));
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
            throw new \RuntimeException('Kajabi access token is not configured.');
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
                    Log::warning("Kajabi API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Kajabi API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Kajabi API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Kajabi API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Kajabi API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Kajabi API: {$e->getMessage()}");
        }
    }
}
