<?php

namespace OpenCompany\Integrations\Salesforce;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Salesforce REST API covering leads, contacts, accounts, opportunities, tasks, cases, queries, and searches.
 *
 * Wraps the Salesforce v60.0 REST API with OAuth2 Bearer token authentication, instance-based URL routing, and error reporting.
 */
class SalesforceService
{
    private const API_VERSION = 'v60.0';

    /**
     * @param  string  $accessToken  OAuth2 access token for Salesforce
     * @param  string  $instanceUrl  Salesforce instance URL (e.g. https://na1.salesforce.com)
     */
    public function __construct(
        private string $accessToken = '',
        private string $instanceUrl = '',
    ) {}

    /**
     * Check whether the Salesforce integration is fully configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accessToken) && ! empty($this->instanceUrl);
    }

    // ── Test Connection ────────────────────────────────────

    /**
     * Test the connection by fetching organization info.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/');
    }

    // ── Leads ──────────────────────────────────────────────

    /**
     * Create a new lead.
     *
     * @param  array<string, mixed>  $fields  Lead field values
     * @return array<string, mixed>  Response with id, success, errors
     */
    public function createLead(array $fields): array
    {
        return $this->request('POST', '/sobjects/Lead', $fields);
    }

    /**
     * Get a lead by ID.
     *
     * @return array<string, mixed>
     */
    public function getLead(string $id): array
    {
        return $this->request('GET', "/sobjects/Lead/{$id}");
    }

    /**
     * Update a lead by ID.
     *
     * @param  array<string, mixed>  $fields  Lead field values to update
     * @return array<string, mixed>  Empty array on 204 success
     */
    public function updateLead(string $id, array $fields): array
    {
        return $this->request('PATCH', "/sobjects/Lead/{$id}", $fields);
    }

    // ── Contacts ───────────────────────────────────────────

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $fields  Contact field values
     * @return array<string, mixed>  Response with id, success, errors
     */
    public function createContact(array $fields): array
    {
        return $this->request('POST', '/sobjects/Contact', $fields);
    }

    /**
     * Get a contact by ID.
     *
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', "/sobjects/Contact/{$id}");
    }

    // ── Accounts ───────────────────────────────────────────

    /**
     * Create a new account.
     *
     * @param  array<string, mixed>  $fields  Account field values
     * @return array<string, mixed>  Response with id, success, errors
     */
    public function createAccount(array $fields): array
    {
        return $this->request('POST', '/sobjects/Account', $fields);
    }

    /**
     * Get an account by ID.
     *
     * @return array<string, mixed>
     */
    public function getAccount(string $id): array
    {
        return $this->request('GET', "/sobjects/Account/{$id}");
    }

    /**
     * Update an account by ID.
     *
     * @param  array<string, mixed>  $fields  Account field values to update
     * @return array<string, mixed>  Empty array on 204 success
     */
    public function updateAccount(string $id, array $fields): array
    {
        return $this->request('PATCH', "/sobjects/Account/{$id}", $fields);
    }

    // ── Opportunities ──────────────────────────────────────

    /**
     * Create a new opportunity.
     *
     * @param  array<string, mixed>  $fields  Opportunity field values
     * @return array<string, mixed>  Response with id, success, errors
     */
    public function createOpportunity(array $fields): array
    {
        return $this->request('POST', '/sobjects/Opportunity', $fields);
    }

    /**
     * Get an opportunity by ID.
     *
     * @return array<string, mixed>
     */
    public function getOpportunity(string $id): array
    {
        return $this->request('GET', "/sobjects/Opportunity/{$id}");
    }

    // ── Tasks ──────────────────────────────────────────────

    /**
     * Create a new task.
     *
     * @param  array<string, mixed>  $fields  Task field values
     * @return array<string, mixed>  Response with id, success, errors
     */
    public function createTask(array $fields): array
    {
        return $this->request('POST', '/sobjects/Task', $fields);
    }

    // ── Cases ──────────────────────────────────────────────

    /**
     * Create a new case.
     *
     * @param  array<string, mixed>  $fields  Case field values
     * @return array<string, mixed>  Response with id, success, errors
     */
    public function createCase(array $fields): array
    {
        return $this->request('POST', '/sobjects/Case', $fields);
    }

    // ── Users ──────────────────────────────────────────────

    /**
     * Get a user by ID.
     *
     * @return array<string, mixed>
     */
    public function getUser(string $id): array
    {
        return $this->request('GET', "/sobjects/User/{$id}");
    }

    // ── Query & Search ─────────────────────────────────────

    /**
     * Execute a SOQL query.
     *
     * @param  string  $soql  SOQL query string (e.g. SELECT Id, Name FROM Account LIMIT 10)
     * @return array<string, mixed>
     */
    public function query(string $soql): array
    {
        return $this->request('GET', '/query', ['q' => $soql]);
    }

    /**
     * Execute a SOSL search.
     *
     * @param  string  $sosl  SOSL search string (e.g. FIND {test} IN ALL FIELDS RETURNING Account(Id, Name))
     * @return array<string, mixed>
     */
    public function search(string $sosl): array
    {
        return $this->request('GET', '/search', ['q' => $sosl]);
    }

    /**
     * Describe metadata for a Salesforce object type.
     *
     * @param  string  $objectType  API name of the object (e.g. Account, Contact, Lead)
     * @return array<string, mixed>
     */
    public function describeObject(string $objectType): array
    {
        return $this->request('GET', "/sobjects/{$objectType}/describe");
    }

    /**
     * List all available Salesforce objects.
     *
     * @return array<string, mixed>
     */
    public function listObjects(): array
    {
        return $this->request('GET', '/sobjects');
    }

    /**
     * List recently accessed items.
     *
     * @param  int  $limit  Maximum number of items to return
     * @return array<string, mixed>
     */
    public function listRecent(int $limit = 25): array
    {
        return $this->request('GET', '/recent', ['limit' => $limit]);
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to Salesforce.
     *
     * @param  array<string, mixed>|string  $data  Query params (GET) or JSON body (POST/PATCH)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array|string $data = []): array
    {
        if (! $this->accessToken || ! $this->instanceUrl) {
            throw new \RuntimeException('Salesforce access token and instance URL are not configured.');
        }

        $baseUrl = rtrim($this->instanceUrl, '/') . '/services/data/' . self::API_VERSION;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($baseUrl . $path, is_array($data) ? $data : []),
                'POST' => $http->post($baseUrl . $path, is_array($data) ? $data : []),
                'PATCH' => $http->patch($baseUrl . $path, is_array($data) ? $data : []),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            // 204 No Content is a valid success response for updates
            if ($response->status() === 204) {
                return [];
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body[0]['message'] ?? $response->body();

                Log::error("Salesforce API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => is_string($err) ? $err : json_encode($err),
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('Salesforce API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Salesforce API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Salesforce API: {$e->getMessage()}");
        }
    }
}
