<?php

namespace OpenCompany\Integrations\Insightly;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Insightly CRM API service.
 *
 * Handles Bearer token authentication and HTTP communication with the Insightly v3.1 REST API.
 * Uses a configurable base URL (default: https://api.na1.insightly.com).
 *
 * @see https://api.na1.insightly.com/v3.1/Help
 */
class InsightlyService
{
    /**
     * Create a new InsightlyService instance.
     *
     * @param  string  $accessToken  Insightly API access token for Bearer authentication.
     * @param  string  $baseUrl  Base URL for the Insightly API (e.g., "https://api.na1.insightly.com").
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.na1.insightly.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List contacts with optional pagination and filtering.
     *
     * @param  int|null  $top  Maximum number of records to return (Insightly $top parameter).
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @param  string|null  $search  Search term to filter contacts by name or email.
     * @return array<int, array<string, mixed>> List of contact records.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/GetEntities
     */
    public function listContacts(?int $top = null, ?int $skip = null, ?string $search = null): array
    {
        $params = array_filter([
            'top' => $top,
            'skip' => $skip,
            'search' => $search,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/v3.1/Contacts', $params);
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
        return $this->request('GET', '/v3.1/Contacts/' . $id);
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
        return $this->request('POST', '/v3.1/Contacts', $data);
    }

    /**
     * List opportunities with optional pagination and filtering.
     *
     * @param  int|null  $top  Maximum number of records to return.
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @param  string|null  $status  Filter by opportunity status (e.g., "Open", "Won", "Lost", "Suspended").
     * @return array<int, array<string, mixed>> List of opportunity records.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Opportunities/GetEntities
     */
    public function listOpportunities(?int $top = null, ?int $skip = null, ?string $status = null): array
    {
        $params = array_filter([
            'top' => $top,
            'skip' => $skip,
            'status' => $status,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/v3.1/Opportunities', $params);
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
        return $this->request('GET', '/v3.1/Opportunities/' . $id);
    }

    /**
     * List projects with optional pagination and filtering.
     *
     * @param  int|null  $top  Maximum number of records to return.
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @param  string|null  $status  Filter by project status (e.g., "In Progress", "Completed", "Scheduled").
     * @return array<int, array<string, mixed>> List of project records.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Projects/GetEntities
     */
    public function listProjects(?int $top = null, ?int $skip = null, ?string $status = null): array
    {
        $params = array_filter([
            'top' => $top,
            'skip' => $skip,
            'status' => $status,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/v3.1/Projects', $params);
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
        return $this->request('GET', '/v3.1/Users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/v3.1/Contacts").
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PUT).
     * @return array<string, mixed> Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Insightly API.
     *
     * Uses Bearer token authentication with the configured access token.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/v3.1/Contacts").
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PUT).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Insightly access token is not configured.');
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
                    Log::warning("Insightly API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Insightly API endpoint not available (HTTP {$response->status()}). Check your base URL and access token.");
                }

                $error = $response->json('ErrorMessage') ?? $response->json('error') ?? $body;
                Log::error("Insightly API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Insightly API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Insightly API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Insightly API: {$e->getMessage()}");
        }
    }
}
