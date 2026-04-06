<?php

namespace OpenCompany\Integrations\Brandfetch;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BrandfetchService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.brandfetch.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get a brand by its domain.
     *
     * @param string $domain The brand domain (e.g., "spotify.com")
     * @return array<string, mixed>
     */
    public function getBrand(string $domain): array
    {
        return $this->request('GET', '/v2/brands/' . urlencode($domain));
    }

    /**
     * Search for brands by query string.
     *
     * @param string   $query Search term (brand name or domain)
     * @param int|null $limit Maximum number of results
     * @return array<string, mixed>
     */
    public function searchBrands(string $query, ?int $limit = null): array
    {
        $params = ['query' => $query];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        return $this->request('GET', '/v2/brands/search', $params);
    }

    /**
     * List logos for a brand.
     *
     * @param string   $brandId The brand identifier
     * @param int|null $limit   Maximum number of results
     * @return array<string, mixed>
     */
    public function listLogos(string $brandId, ?int $limit = null): array
    {
        $params = ['brand_id' => $brandId];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        return $this->request('GET', '/v2/logos', $params);
    }

    /**
     * Get a single logo by its ID.
     *
     * @param string $id The logo identifier
     * @return array<string, mixed>
     */
    public function getLogo(string $id): array
    {
        return $this->request('GET', '/v2/logos/' . urlencode($id));
    }

    /**
     * List colors for a brand.
     *
     * @param string   $brandId The brand identifier
     * @param int|null $limit   Maximum number of results
     * @return array<string, mixed>
     */
    public function listColors(string $brandId, ?int $limit = null): array
    {
        $params = ['brand_id' => $brandId];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        return $this->request('GET', '/v2/colors', $params);
    }

    /**
     * List fonts for a brand.
     *
     * @param string   $brandId The brand identifier
     * @param int|null $limit   Maximum number of results
     * @return array<string, mixed>
     */
    public function listFonts(string $brandId, ?int $limit = null): array
    {
        $params = ['brand_id' => $brandId];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }

        return $this->request('GET', '/v2/fonts', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method
     * @param string $path   API path
     * @param array<string, mixed> $data Query parameters or request body
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Brandfetch API.
     *
     * @param string $method HTTP method
     * @param string $path   API path
     * @param array<string, mixed> $data Query parameters or request body
     * @return \Illuminate\Http\Client\Response
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Brandfetch access token is not configured.');
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
                    Log::warning("Brandfetch API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Brandfetch API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Brandfetch API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Brandfetch API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Brandfetch API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Brandfetch API: {$e->getMessage()}");
        }
    }
}
