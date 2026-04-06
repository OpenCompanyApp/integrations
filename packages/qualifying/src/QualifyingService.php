<?php

namespace OpenCompany\Integrations\Qualifying;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QualifyingService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.qualifying.ai',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List accounts with pagination.
     *
     * @param  int  $limit  Maximum number of accounts to return (default: 25).
     * @param  int  $page  Page number for pagination (default: 1).
     * @return array<string, mixed>
     */
    public function listAccounts(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/api/v1/accounts', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single account by ID.
     *
     * @param  string  $id  The account identifier.
     * @return array<string, mixed>
     */
    public function getAccount(string $id): array
    {
        return $this->request('GET', '/api/v1/accounts/' . urlencode($id));
    }

    /**
     * List contacts with pagination and optional account filter.
     *
     * @param  int  $limit  Maximum number of contacts to return (default: 25).
     * @param  int  $page  Page number for pagination (default: 1).
     * @param  string|null  $accountId  Filter contacts by account ID.
     * @return array<string, mixed>
     */
    public function listContacts(int $limit = 25, int $page = 1, ?string $accountId = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($accountId !== null) {
            $params['account_id'] = $accountId;
        }

        return $this->request('GET', '/api/v1/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $id  The contact identifier.
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/api/v1/contacts/' . urlencode($id));
    }

    /**
     * List deals with pagination and optional stage filter.
     *
     * @param  int  $limit  Maximum number of deals to return (default: 25).
     * @param  int  $page  Page number for pagination (default: 1).
     * @param  string|null  $stage  Filter deals by stage (e.g., "lead", "qualified", "won", "lost").
     * @return array<string, mixed>
     */
    public function listDeals(int $limit = 25, int $page = 1, ?string $stage = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($stage !== null) {
            $params['stage'] = $stage;
        }

        return $this->request('GET', '/api/v1/deals', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/v1/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Qualifying API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the request fails or the service is not configured.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Qualifying access token is not configured.');
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
                    Log::warning("Qualifying API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Qualifying API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Qualifying API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Qualifying API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Qualifying API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Qualifying API: {$e->getMessage()}");
        }
    }
}
