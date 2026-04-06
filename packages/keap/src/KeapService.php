<?php

namespace OpenCompany\Integrations\Keap;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KeapService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.keap.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Keap integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List contacts with optional pagination.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', '/api/v1/contacts', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  int|string  $id  The Keap contact ID.
     * @return array<string, mixed>
     */
    public function getContact(int|string $id): array
    {
        return $this->request('GET', '/api/v1/contacts/' . urlencode((string) $id));
    }

    /**
     * Create a new contact.
     *
     * @param  array  $data  Contact fields (first_name, last_name, email, company_name, etc.).
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/api/v1/contacts', $data);
    }

    /**
     * List opportunities with optional pagination and stage filter.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $stage  Filter by opportunity stage.
     * @return array<string, mixed>
     */
    public function listOpportunities(int $page = 1, int $limit = 20, ?string $stage = null): array
    {
        $params = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($stage !== null) {
            $params['stage'] = $stage;
        }

        return $this->request('GET', '/api/v1/opportunities', $params);
    }

    /**
     * Get a single opportunity by ID.
     *
     * @param  int|string  $id  The Keap opportunity ID.
     * @return array<string, mixed>
     */
    public function getOpportunity(int|string $id): array
    {
        return $this->request('GET', '/api/v1/opportunities/' . urlencode((string) $id));
    }

    /**
     * List all tags.
     *
     * @return array<string, mixed>
     */
    public function listTags(): array
    {
        return $this->request('GET', '/api/v1/tags');
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
     * Make a raw HTTP request to the Keap API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the API key is missing, the request fails, or a connection error occurs.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Keap access token is not configured.');
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
                    Log::warning("Keap API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Keap API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Keap API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Keap API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Keap API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Keap API: {$e->getMessage()}");
        }
    }
}
