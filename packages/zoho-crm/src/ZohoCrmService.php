<?php

namespace OpenCompany\Integrations\ZohoCrm;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Zoho CRM REST API v7 covering leads, contacts, accounts, deals, and users.
 *
 * Wraps the Zoho CRM v7 REST API with OAuth2 token authentication using the
 * {@code Zoho-oauthtoken} authorization prefix, request routing, and error reporting.
 *
 * Zoho CRM uses a data-wrapping convention where request payloads and responses
 * are enclosed in a top-level {@code "data"} array:
 *
 *   Request:  {"data": [{"First_Name": "John"}]}
 *   Response: {"data": [{"code": "SUCCESS", "details": {}}]}
 */
class ZohoCrmService
{
    private const BASE_URL = 'https://www.zohoapis.com/crm/v7';

    /**
     * @param  string  $accessToken  Zoho OAuth2 access token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    /**
     * Check whether the Zoho CRM integration is fully configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Test Connection ────────────────────────────────────

    /**
     * Test the connection by fetching the current user profile.
     *
     * @return array<string, mixed>  User profile data
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── Leads ──────────────────────────────────────────────

    /**
     * Create a new lead in Zoho CRM.
     *
     * @param  array<string, mixed>  $fields  Lead field values (Zoho API names: First_Name, Last_Name, Company, Email, Phone)
     * @return array<string, mixed>  Response data array from Zoho
     */
    public function createLead(array $fields): array
    {
        return $this->request('POST', '/Leads', $fields);
    }

    /**
     * Get a lead by its Zoho CRM ID.
     *
     * @param  string  $id  Zoho CRM lead ID
     * @return array<string, mixed>  Lead record data
     */
    public function getLead(string $id): array
    {
        return $this->request('GET', "/Leads/{$id}");
    }

    /**
     * Update an existing lead by its Zoho CRM ID.
     *
     * @param  string  $id  Zoho CRM lead ID
     * @param  array<string, mixed>  $fields  Lead field values to update
     * @return array<string, mixed>  Response data array from Zoho
     */
    public function updateLead(string $id, array $fields): array
    {
        return $this->request('PUT', "/Leads/{$id}", $fields);
    }

    /**
     * Search leads by criteria or email.
     *
     * @param  array<string, mixed>  $params  Query parameters (criteria, email, etc.)
     * @return array<string, mixed>  Search results
     */
    public function searchLeads(array $params = []): array
    {
        return $this->request('GET', '/Leads/search', $params);
    }

    // ── Contacts ───────────────────────────────────────────

    /**
     * Create a new contact in Zoho CRM.
     *
     * @param  array<string, mixed>  $fields  Contact field values (Zoho API names: First_Name, Last_Name, Email, Phone)
     * @return array<string, mixed>  Response data array from Zoho
     */
    public function createContact(array $fields): array
    {
        return $this->request('POST', '/Contacts', $fields);
    }

    /**
     * Get a contact by its Zoho CRM ID.
     *
     * @param  string  $id  Zoho CRM contact ID
     * @return array<string, mixed>  Contact record data
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', "/Contacts/{$id}");
    }

    /**
     * Update an existing contact by its Zoho CRM ID.
     *
     * @param  string  $id  Zoho CRM contact ID
     * @param  array<string, mixed>  $fields  Contact field values to update
     * @return array<string, mixed>  Response data array from Zoho
     */
    public function updateContact(string $id, array $fields): array
    {
        return $this->request('PUT', "/Contacts/{$id}", $fields);
    }

    /**
     * Search contacts by criteria or email.
     *
     * @param  array<string, mixed>  $params  Query parameters (criteria, email, etc.)
     * @return array<string, mixed>  Search results
     */
    public function searchContacts(array $params = []): array
    {
        return $this->request('GET', '/Contacts/search', $params);
    }

    // ── Accounts ───────────────────────────────────────────

    /**
     * Create a new account in Zoho CRM.
     *
     * @param  array<string, mixed>  $fields  Account field values (Zoho API names: Account_Name, Website, Phone, Industry)
     * @return array<string, mixed>  Response data array from Zoho
     */
    public function createAccount(array $fields): array
    {
        return $this->request('POST', '/Accounts', $fields);
    }

    /**
     * Get an account by its Zoho CRM ID.
     *
     * @param  string  $id  Zoho CRM account ID
     * @return array<string, mixed>  Account record data
     */
    public function getAccount(string $id): array
    {
        return $this->request('GET', "/Accounts/{$id}");
    }

    // ── Deals ──────────────────────────────────────────────

    /**
     * Create a new deal in Zoho CRM.
     *
     * @param  array<string, mixed>  $fields  Deal field values (Zoho API names: Deal_Name, Amount, Stage, Closing_Date, Account_Name)
     * @return array<string, mixed>  Response data array from Zoho
     */
    public function createDeal(array $fields): array
    {
        return $this->request('POST', '/Deals', $fields);
    }

    /**
     * Get a deal by its Zoho CRM ID.
     *
     * @param  string  $id  Zoho CRM deal ID
     * @return array<string, mixed>  Deal record data
     */
    public function getDeal(string $id): array
    {
        return $this->request('GET', "/Deals/{$id}");
    }

    /**
     * List deals with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, per_page, etc.)
     * @return array<string, mixed>  List of deal records
     */
    public function listDeals(array $params = []): array
    {
        return $this->request('GET', '/Deals', $params);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * List users with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (type, page, etc.)
     * @return array<string, mixed>  List of user records
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>  Current user profile data
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to Zoho CRM.
     *
     * Wraps the request payload in Zoho's {@code {"data": [...]}} convention for
     * write operations (POST, PUT) and passes query parameters for read operations (GET).
     *
     * @param  string  $method  HTTP method (GET, POST, PUT)
     * @param  string  $path    API path relative to the base URL
     * @param  array<string, mixed>  $data  Query params (GET) or record fields (POST/PUT)
     * @return array<string, mixed>  Decoded JSON response
     *
     * @throws \RuntimeException  If the token is missing or the API returns an error
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('Zoho CRM access token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Zoho-oauthtoken ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get(self::BASE_URL . $path, $data),
                'POST' => $http->post(self::BASE_URL . $path, ['data' => [$data]]),
                'PUT' => $http->put(self::BASE_URL . $path, ['data' => [$data]]),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['message'] ?? $response->body();

                Log::error("Zoho CRM API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => is_string($err) ? $err : json_encode($err),
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Zoho CRM API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoho CRM API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zoho CRM API: {$e->getMessage()}");
        }
    }
}
