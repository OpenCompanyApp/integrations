<?php

namespace OpenCompany\Integrations\Insightly;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Insightly CRM API service.
 *
 * Handles authentication and HTTP communication with the Insightly v3.1 REST API.
 * Uses HTTP Basic authentication with the API key as the username and an empty password.
 *
 * @see https://api.na1.insightly.com/v3.1/Help
 */
class InsightlyService
{
    /**
     * Create a new InsightlyService instance.
     *
     * @param  string  $apiKey  Insightly API key for HTTP Basic authentication.
     * @param  string  $region  API region code (e.g., "na1", "eu1", "au1").
     */
    public function __construct(
        private string $apiKey = '',
        private string $region = 'na1',
    ) {}

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the configured region code.
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * Get the base URL for the Insightly API based on the configured region.
     *
     * @return string The base URL, e.g. "https://api.na1.insightly.com/v3.1"
     */
    public function getBaseUrl(): string
    {
        return 'https://api.' . $this->region . '.insightly.com/v3.1';
    }

    /**
     * List contacts with optional pagination and filtering.
     *
     * @param  int|null  $top  Maximum number of records to return (Insightly $top parameter).
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @param  string|null  $brief  Set to "true" to return a reduced payload.
     * @param  string|null  $orderBy  Order results by a field (e.g., "DATE_CREATED_UTC desc").
     * @param  string|null  $filter  Insightly filter expression.
     * @return array<int, array<string, mixed>> List of contact records.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/GetEntities
     */
    public function listContacts(?int $top = null, ?int $skip = null, ?string $brief = null, ?string $orderBy = null, ?string $filter = null): array
    {
        $params = array_filter([
            'top' => $top,
            'skip' => $skip,
            'brief' => $brief,
            'orderby' => $orderBy,
            'filter' => $filter,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/Contacts', $params);
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
        return $this->request('GET', '/Contacts/' . $id);
    }

    /**
     * Create a new contact in Insightly.
     *
     * @param  array<string, mixed>  $data  Contact fields (e.g., FIRST_NAME, LAST_NAME, EMAIL, PHONE, etc.).
     * @return array<string, mixed> The created contact record.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/PostEntity
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/Contacts', $data);
    }

    /**
     * Update an existing contact in Insightly.
     *
     * @param  int  $id  The Insightly contact ID to update.
     * @param  array<string, mixed>  $data  Contact fields to update. Must include CONTACT_ID.
     * @return array<string, mixed> The updated contact record.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Contacts/PutEntity
     */
    public function updateContact(int $id, array $data): array
    {
        $data['CONTACT_ID'] = $id;

        return $this->request('PUT', '/Contacts/' . $id, $data);
    }

    /**
     * List deals (opportunities) with optional pagination and filtering.
     *
     * @param  int|null  $top  Maximum number of records to return.
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @param  string|null  $brief  Set to "true" for a reduced payload.
     * @param  string|null  $orderBy  Order results by a field.
     * @param  string|null  $filter  Insightly filter expression.
     * @return array<int, array<string, mixed>> List of opportunity records.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Opportunities/GetEntities
     */
    public function listDeals(?int $top = null, ?int $skip = null, ?string $brief = null, ?string $orderBy = null, ?string $filter = null): array
    {
        $params = array_filter([
            'top' => $top,
            'skip' => $skip,
            'brief' => $brief,
            'orderby' => $orderBy,
            'filter' => $filter,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/Opportunities', $params);
    }

    /**
     * Get a single deal (opportunity) by its ID.
     *
     * @param  int  $id  The Insightly opportunity ID.
     * @return array<string, mixed> The opportunity record.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Opportunities/GetEntity
     */
    public function getDeal(int $id): array
    {
        return $this->request('GET', '/Opportunities/' . $id);
    }

    /**
     * Create a new deal (opportunity) in Insightly.
     *
     * @param  array<string, mixed>  $data  Opportunity fields (e.g., OPPORTUNITY_NAME, BID_AMOUNT, etc.).
     * @return array<string, mixed> The created opportunity record.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Opportunities/PostEntity
     */
    public function createDeal(array $data): array
    {
        return $this->request('POST', '/Opportunities', $data);
    }

    /**
     * List projects with optional pagination and filtering.
     *
     * @param  int|null  $top  Maximum number of records to return.
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @param  string|null  $brief  Set to "true" for a reduced payload.
     * @param  string|null  $orderBy  Order results by a field.
     * @param  string|null  $filter  Insightly filter expression.
     * @return array<int, array<string, mixed>> List of project records.
     *
     * @see https://api.na1.insightly.com/v3.1/Help#!/Projects/GetEntities
     */
    public function listProjects(?int $top = null, ?int $skip = null, ?string $brief = null, ?string $orderBy = null, ?string $filter = null): array
    {
        $params = array_filter([
            'top' => $top,
            'skip' => $skip,
            'brief' => $brief,
            'orderby' => $orderBy,
            'filter' => $filter,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/Projects', $params);
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
        return $this->request('GET', '/Users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/Contacts").
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
     * Uses HTTP Basic authentication with the API key as the username and an empty password.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., "/Contacts").
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PUT).
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Insightly API key is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apiKey, '')->timeout(30);

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
                    throw new \RuntimeException("Insightly API endpoint not available (HTTP {$response->status()}). Check your region and API key.");
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
