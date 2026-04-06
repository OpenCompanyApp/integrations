<?php

namespace OpenCompany\Integrations\Ahrefs;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AhrefsService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.ahrefs.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List backlinks for a target.
     *
     * @param  string  $target  The target URL or domain (e.g., "example.com").
     * @param  int  $limit  Maximum number of results to return (default: 100).
     * @param  int  $offset  Number of results to skip for pagination.
     * @param  string  $mode  Target mode: "domain", "subdomain", "exact", "prefix".
     * @return array<string, mixed>
     */
    public function listBacklinks(string $target, int $limit = 100, int $offset = 0, string $mode = 'domain'): array
    {
        return $this->request('GET', '/v3/site-explorer/backlinks', [
            'target' => $target,
            'limit' => $limit,
            'offset' => $offset,
            'mode' => $mode,
        ]);
    }

    /**
     * List referring domains for a target.
     *
     * @param  string  $target  The target URL or domain (e.g., "example.com").
     * @param  int  $limit  Maximum number of results to return (default: 100).
     * @param  int  $offset  Number of results to skip for pagination.
     * @param  string  $mode  Target mode: "domain", "subdomain", "exact", "prefix".
     * @return array<string, mixed>
     */
    public function listReferringDomains(string $target, int $limit = 100, int $offset = 0, string $mode = 'domain'): array
    {
        return $this->request('GET', '/v3/site-explorer/referring-domains', [
            'target' => $target,
            'limit' => $limit,
            'offset' => $offset,
            'mode' => $mode,
        ]);
    }

    /**
     * List organic keywords for a target.
     *
     * @param  string  $target  The target URL or domain (e.g., "example.com").
     * @param  int  $limit  Maximum number of results to return (default: 100).
     * @param  int  $offset  Number of results to skip for pagination.
     * @param  string  $mode  Target mode: "domain", "subdomain", "exact", "prefix".
     * @return array<string, mixed>
     */
    public function listOrganicKeywords(string $target, int $limit = 100, int $offset = 0, string $mode = 'domain'): array
    {
        return $this->request('GET', '/v3/site-explorer/organic-keywords', [
            'target' => $target,
            'limit' => $limit,
            'offset' => $offset,
            'mode' => $mode,
        ]);
    }

    /**
     * List top pages for a target.
     *
     * @param  string  $target  The target URL or domain (e.g., "example.com").
     * @param  int  $limit  Maximum number of results to return (default: 100).
     * @param  int  $offset  Number of results to skip for pagination.
     * @param  string  $mode  Target mode: "domain", "subdomain", "exact", "prefix".
     * @return array<string, mixed>
     */
    public function listPages(string $target, int $limit = 100, int $offset = 0, string $mode = 'domain'): array
    {
        return $this->request('GET', '/v3/site-explorer/pages', [
            'target' => $target,
            'limit' => $limit,
            'offset' => $offset,
            'mode' => $mode,
        ]);
    }

    /**
     * List paid keywords for a target.
     *
     * @param  string  $target  The target URL or domain (e.g., "example.com").
     * @param  int  $limit  Maximum number of results to return (default: 100).
     * @param  int  $offset  Number of results to skip for pagination.
     * @return array<string, mixed>
     */
    public function listPaidKeywords(string $target, int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/v3/site-explorer/paid-keywords', [
            'target' => $target,
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * List anchor text for backlinks to a target.
     *
     * @param  string  $target  The target URL or domain (e.g., "example.com").
     * @param  int  $limit  Maximum number of results to return (default: 100).
     * @param  int  $offset  Number of results to skip for pagination.
     * @return array<string, mixed>
     */
    public function listAnchors(string $target, int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/v3/site-explorer/anchors', [
            'target' => $target,
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v3/users/me');
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
     * Make a raw HTTP request to the Ahrefs API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Ahrefs API key is not configured.');
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
                    Log::warning("Ahrefs API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Ahrefs API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not be accessible with your current plan.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Ahrefs API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Ahrefs API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Ahrefs API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Ahrefs API: {$e->getMessage()}");
        }
    }
}
