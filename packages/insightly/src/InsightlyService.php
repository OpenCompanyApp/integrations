<?php

namespace OpenCompany\Integrations\Insightly;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * Insightly CRM API service.
 *
 * Handles HTTP Basic API-key authentication and HTTP communication with the Insightly v3.1 REST API.
 * Uses a configurable base URL (default: https://api.na1.insightly.com).
 *
 * @see https://api.na1.insightly.com/v3.1/Help
 */
class InsightlyService
{
    /**
     * Create a new InsightlyService instance.
     *
     * @param  string  $apiKey  Insightly API key used as the Basic username.
     * @param  string  $baseUrl  Base URL for the Insightly API (e.g., "https://api.na1.insightly.com").
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.na1.insightly.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * List contacts with optional pagination.
     *
     * @param  int|null  $top  Maximum number of records to return (Insightly $top parameter).
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @param  bool|null  $brief  Return only top-level record properties.
     * @param  bool|null  $countTotal  Ask Insightly to include the total record count in response headers.
     * @return array<int, array<string, mixed>> List of contact records.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/GetEntities
     */
    public function listContacts(?int $top = null, ?int $skip = null, ?bool $brief = null, ?bool $countTotal = null): array
    {
        $params = array_filter([
            'top' => $top,
            'skip' => $skip,
            'brief' => $brief,
            'count_total' => $countTotal,
        ], fn ($value) => $value !== null);

        return $this->apiGet('/v3.1/Contacts', $params);
    }

    /**
     * Get a single contact by its ID.
     *
     * @param  int  $id  The Insightly contact ID.
     * @return array<string, mixed> The contact record.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/GetEntity
     */
    public function getContact(int $id): array
    {
        return $this->apiGet('/v3.1/Contacts/' . $id);
    }

    /**
     * Create a new contact in Insightly.
     *
     * @param  array<string, mixed>  $data  Contact fields (e.g., FIRST_NAME, LAST_NAME, EMAIL, PHONE).
     * @return array<string, mixed> The created contact record.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/PostEntity
     */
    public function createContact(array $data): array
    {
        return $this->apiPost('/v3.1/Contacts', $data);
    }

    /**
     * List opportunities with optional pagination.
     *
     * @param  int|null  $top  Maximum number of records to return.
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @param  bool|null  $brief  Return only top-level record properties.
     * @param  bool|null  $countTotal  Ask Insightly to include the total record count in response headers.
     * @return array<int, array<string, mixed>> List of opportunity records.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Opportunities/GetEntities
     */
    public function listOpportunities(?int $top = null, ?int $skip = null, ?bool $brief = null, ?bool $countTotal = null): array
    {
        $params = array_filter([
            'top' => $top,
            'skip' => $skip,
            'brief' => $brief,
            'count_total' => $countTotal,
        ], fn ($value) => $value !== null);

        return $this->apiGet('/v3.1/Opportunities', $params);
    }

    /**
     * Get a single opportunity by its ID.
     *
     * @param  int  $id  The Insightly opportunity ID.
     * @return array<string, mixed> The opportunity record.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Opportunities/GetEntity
     */
    public function getOpportunity(int $id): array
    {
        return $this->apiGet('/v3.1/Opportunities/' . $id);
    }

    /**
     * List projects with optional pagination.
     *
     * @param  int|null  $top  Maximum number of records to return.
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @param  bool|null  $brief  Return only top-level record properties.
     * @param  bool|null  $countTotal  Ask Insightly to include the total record count in response headers.
     * @return array<int, array<string, mixed>> List of project records.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Projects/GetEntities
     */
    public function listProjects(?int $top = null, ?int $skip = null, ?bool $brief = null, ?bool $countTotal = null): array
    {
        $params = array_filter([
            'top' => $top,
            'skip' => $skip,
            'brief' => $brief,
            'count_total' => $countTotal,
        ], fn ($value) => $value !== null);

        return $this->apiGet('/v3.1/Projects', $params);
    }

    /**
     * Get the currently authenticated Insightly user.
     *
     * @return array<string, mixed> The current user record.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Users/GetMe
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/v3.1/Users/Me');
    }

    /**
     * Run a GET request against an Insightly API path.
     *
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Run a POST request against an Insightly API path.
     *
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $query, $body);
    }

    /**
     * Run a PUT request against an Insightly API path.
     *
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, $query, $body);
    }

    /**
     * Run a DELETE request against an Insightly API path.
     *
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/v3.1/Contacts").
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204 || trim($response->body()) === '') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Insightly API.
     *
     * Uses HTTP Basic authentication with the configured API key.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/v3.1/Contacts").
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return Response The raw HTTP response.
     *
     * @throws RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('Insightly API key is not configured.');
        }

        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($this->apiKey),
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Insightly API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Insightly API endpoint not available (HTTP {$response->status()}). Check your base URL and API key.");
                }

                $error = $response->json('ErrorMessage') ?? $response->json('error') ?? $body;
                Log::error("Insightly API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Insightly API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Insightly API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Insightly API: {$e->getMessage()}");
        }
    }

    /**
     * Build an Insightly request URL with query parameters.
     *
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query = []): string
    {
        $url = $this->baseUrl . '/' . ltrim($path, '/');
        $query = array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');

        if ($query === []) {
            return $url;
        }

        return $url . '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    }
}
