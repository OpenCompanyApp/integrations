<?php

namespace OpenCompany\Integrations\Outreach;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OutreachService
{
    /**
     * Create a new Outreach API service instance.
     *
     * @param string $accessToken The OAuth2 access token for API authentication.
     * @param string $baseUrl     The base URL for the Outreach API (default: https://api.outreach.io/api/v2).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.outreach.io/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     *
     * @return bool True if the access token is set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List prospects with optional filtering, sorting, and pagination.
     *
     * @param  array $params Query parameters (page_size, page_number, sort, filter, etc.).
     * @return array The parsed JSON:API response.
     */
    public function listProspects(array $params = []): array
    {
        return $this->request('GET', '/prospects', $params);
    }

    /**
     * Get a single prospect by ID.
     *
     * @param  int|string $id The prospect ID.
     * @return array The parsed JSON:API response.
     */
    public function getProspect(int|string $id): array
    {
        return $this->request('GET', '/prospects/' . $id);
    }

    /**
     * Create a new prospect using JSON:API format.
     *
     * The provided data is automatically wrapped in the JSON:API structure:
     * {"data": {"type": "prospect", "attributes": {...}}}
     *
     * @param  array $data The prospect attributes (first_name, last_name, emails, company, etc.).
     * @return array The parsed JSON:API response.
     */
    public function createProspect(array $data): array
    {
        $payload = [
            'data' => [
                'type' => 'prospect',
                'attributes' => $data,
            ],
        ];

        return $this->request('POST', '/prospects', $payload);
    }

    /**
     * List sequences with optional pagination.
     *
     * @param  array $params Query parameters (page_size, page_number, etc.).
     * @return array The parsed JSON:API response.
     */
    public function listSequences(array $params = []): array
    {
        return $this->request('GET', '/sequences', $params);
    }

    /**
     * Get a single sequence by ID.
     *
     * @param  int|string $id The sequence ID.
     * @return array The parsed JSON:API response.
     */
    public function getSequence(int|string $id): array
    {
        return $this->request('GET', '/sequences/' . $id);
    }

    /**
     * List accounts with optional pagination.
     *
     * @param  array $params Query parameters (page_size, page_number, etc.).
     * @return array The parsed JSON:API response.
     */
    public function listAccounts(array $params = []): array
    {
        return $this->request('GET', '/accounts', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array The parsed JSON:API response.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * For GET requests, $data is sent as query parameters.
     * For POST/PUT/PATCH requests, $data is sent as JSON body.
     *
     * @param  string $method The HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string $path   The API endpoint path (e.g., "/prospects").
     * @param  array  $data   Request data (query params or JSON body).
     * @return array The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Outreach API.
     *
     * @param  string $method The HTTP method.
     * @param  string $path   The API endpoint path.
     * @param  array  $data   Request data.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the request fails or the service is not configured.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Outreach access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/vnd.api+json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('errors.0.detail') ?? $response->body();

                Log::error("Outreach API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Outreach API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Outreach API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Outreach API: {$e->getMessage()}");
        }
    }
}
