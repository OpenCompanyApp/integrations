<?php

namespace OpenCompany\Integrations\Unbounce;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UnbounceService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.unbounce.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List landing pages.
     *
     * @param  int  $limit   Maximum number of pages to return (default 50, max 1000).
     * @param  int  $offset  Offset for pagination (default 0).
     * @param  string|null  $sort  Sort order (e.g. "created_at", "-created_at").
     * @return array<string, mixed>
     */
    public function listPages(int $limit = 50, int $offset = 0, ?string $sort = null): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];
        if ($sort !== null) {
            $params['sort'] = $sort;
        }

        return $this->request('GET', '/pages', $params);
    }

    /**
     * Get a single landing page by ID.
     *
     * @param  string  $pageId  The Unbounce page ID.
     * @return array<string, mixed>
     */
    public function getPage(string $pageId): array
    {
        return $this->request('GET', '/pages/' . urlencode($pageId));
    }

    /**
     * List leads (form submissions) for a page.
     *
     * @param  string  $pageId  The Unbounce page ID.
     * @param  int  $limit   Maximum number of leads to return (default 50, max 1000).
     * @param  int  $offset  Offset for pagination (default 0).
     * @return array<string, mixed>
     */
    public function listLeads(string $pageId, int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/pages/' . urlencode($pageId) . '/leads', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single lead by ID.
     *
     * @param  string  $leadId  The Unbounce lead ID.
     * @return array<string, mixed>
     */
    public function getLead(string $leadId): array
    {
        return $this->request('GET', '/leads/' . urlencode($leadId));
    }

    /**
     * List sub-accounts.
     *
     * @param  int  $limit   Maximum number of sub-accounts to return (default 50, max 1000).
     * @param  int  $offset  Offset for pagination (default 0).
     * @return array<string, mixed>
     */
    public function listSubAccounts(int $limit = 50, int $offset = 0): array
    {
        return $this->request('GET', '/sub_accounts', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get the currently authenticated user.
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
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. "/pages").
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Unbounce API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query params or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Unbounce access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Unbounce API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Unbounce API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Unbounce API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Unbounce API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Unbounce API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Unbounce API: {$e->getMessage()}");
        }
    }
}
