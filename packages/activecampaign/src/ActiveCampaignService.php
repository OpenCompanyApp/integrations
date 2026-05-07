<?php

namespace OpenCompany\Integrations\ActiveCampaign;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the ActiveCampaign API v3.
 *
 * Handles authentication via API token header and provides methods
 * for managing contacts, lists, deals, automations, and notes.
 */
class ActiveCampaignService
{
    /**
     * @param string $apiKey     The ActiveCampaign API token.
     * @param string $accountName The ActiveCampaign account name used in the API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $accountName = '',
    ) {}

    /**
     * Check whether the service is properly configured with an API key and account name.
     *
     * @return bool True if both API key and account name are set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->accountName);
    }

    /**
     * Build the base URL for the ActiveCampaign API.
     *
     * @return string The fully qualified API base URL.
     */
    public function getBaseUrl(): string
    {
        return "https://{$this->accountName}.api-us1.com/api/3";
    }

    // ── Users ──────────────────────────────────────────────────────────

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * List users in the account.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    // ── Contacts ───────────────────────────────────────────────────────

    /**
     * List contacts with optional pagination, search, and filters.
     *
     * @param  int|null    $limit   Number of results per page (default 20, max 100).
     * @param  int|null    $offset  Offset for pagination.
     * @param  string|null $search  Search term to filter contacts.
     * @param  array       $filters Additional query filters.
     * @return array       The API response containing contacts and meta.
     */
    public function listContacts(?int $limit = null, ?int $offset = null, ?string $search = null, array $filters = []): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }
        if ($search !== null) {
            $params['search'] = $search;
        }
        foreach ($filters as $key => $value) {
            $params[$key] = $value;
        }

        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  int   $contactId The contact ID.
     * @return array The API response containing the contact.
     */
    public function getContact(int $contactId): array
    {
        return $this->request('GET', "/contacts/{$contactId}");
    }

    /**
     * Create a new contact.
     *
     * @param  string $email     The contact email address.
     * @param  string $firstName The contact first name.
     * @param  string $lastName  The contact last name.
     * @param  string $phone     The contact phone number.
     * @param  array  $extra     Additional contact fields.
     * @return array  The API response containing the created contact.
     */
    public function createContact(string $email, string $firstName = '', string $lastName = '', string $phone = '', array $extra = []): array
    {
        $contact = array_filter([
            'email' => $email,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'phone' => $phone,
        ], fn($v) => $v !== '');

        $contact = array_merge($contact, $extra);

        return $this->request('POST', '/contacts', ['contact' => $contact]);
    }

    /**
     * Create or update a contact by email using ActiveCampaign's sync endpoint.
     *
     * @param  array<string, mixed>  $contact  Contact payload.
     * @return array<string, mixed>
     */
    public function syncContact(array $contact): array
    {
        return $this->request('POST', '/contact/sync', ['contact' => $contact]);
    }

    /**
     * Update an existing contact.
     *
     * @param  int    $contactId The contact ID to update.
     * @param  array  $data      The contact fields to update.
     * @return array  The API response containing the updated contact.
     */
    public function updateContact(int $contactId, array $data): array
    {
        return $this->request('PUT', "/contacts/{$contactId}", ['contact' => $data]);
    }

    /**
     * Delete a contact by ID.
     *
     * @param int $contactId The contact ID to delete.
     * @return array Empty array on success.
     */
    public function deleteContact(int $contactId): array
    {
        return $this->request('DELETE', "/contacts/{$contactId}");
    }

    // ── Lists ──────────────────────────────────────────────────────────

    /**
     * List all lists in the account.
     *
     * @param  int|null $limit  Number of results per page.
     * @param  int|null $offset Offset for pagination.
     * @return array    The API response containing lists.
     */
    public function listLists(?int $limit = null, ?int $offset = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/lists', $params);
    }

    /**
     * Get a single list by ID.
     *
     * @param  int   $listId The list ID.
     * @return array The API response containing the list.
     */
    public function getList(int $listId): array
    {
        return $this->request('GET', "/lists/{$listId}");
    }

    // ── Contact Lists ──────────────────────────────────────────────────

    /**
     * Add a contact to a list (subscribe).
     *
     * @param  int $contactId The contact ID.
     * @param  int $listId    The list ID.
     * @param  int $status    Status value (1 = subscribe, default).
     * @return array The API response.
     */
    public function addContactToList(int $contactId, int $listId, int $status = 1): array
    {
        return $this->request('POST', '/contactLists', [
            'contactList' => [
                'list' => $listId,
                'contact' => $contactId,
                'status' => $status,
            ],
        ]);
    }

    /**
     * Remove a contact from a list (unsubscribe).
     *
     * @param  int $contactId The contact ID.
     * @param  int $listId    The list ID.
     * @return array The API response.
     */
    public function removeContactFromList(int $contactId, int $listId): array
    {
        return $this->request('POST', '/contactLists', [
            'contactList' => [
                'list' => $listId,
                'contact' => $contactId,
                'status' => 2,
            ],
        ]);
    }

    // ── Tags and Fields ────────────────────────────────────────────────

    /**
     * List all tags.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listTags(array $params = []): array
    {
        return $this->request('GET', '/tags', $params);
    }

    /**
     * Create a tag.
     *
     * @param  string  $tag  Tag name.
     * @param  string|null  $description  Optional tag description.
     * @param  string|null  $tagType  Optional tag type.
     * @return array<string, mixed>
     */
    public function createTag(string $tag, ?string $description = null, ?string $tagType = null): array
    {
        $payload = ['tag' => ['tag' => $tag]];

        if ($description !== null && $description !== '') {
            $payload['tag']['description'] = $description;
        }

        if ($tagType !== null && $tagType !== '') {
            $payload['tag']['tagType'] = $tagType;
        }

        return $this->request('POST', '/tags', $payload);
    }

    /**
     * Add an existing tag to a contact.
     *
     * @param  int  $contactId  Contact ID.
     * @param  int  $tagId  Tag ID.
     * @return array<string, mixed>
     */
    public function addContactTag(int $contactId, int $tagId): array
    {
        return $this->request('POST', '/contactTags', [
            'contactTag' => [
                'contact' => $contactId,
                'tag' => $tagId,
            ],
        ]);
    }

    /**
     * Remove a tag relationship from a contact.
     *
     * @param  int  $contactTagId  Contact-tag relationship ID.
     * @return array<string, mixed>
     */
    public function removeContactTag(int $contactTagId): array
    {
        return $this->request('DELETE', "/contactTags/{$contactTagId}");
    }

    /**
     * List tags applied to a contact.
     *
     * @param  int  $contactId  Contact ID.
     * @return array<string, mixed>
     */
    public function listContactTags(int $contactId): array
    {
        return $this->request('GET', "/contacts/{$contactId}/contactTags");
    }

    /**
     * List custom contact fields.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listFields(array $params = []): array
    {
        return $this->request('GET', '/fields', $params);
    }

    /**
     * Create a custom contact field.
     *
     * @param  array<string, mixed>  $field  Field payload.
     * @return array<string, mixed>
     */
    public function createField(array $field): array
    {
        return $this->request('POST', '/fields', ['field' => $field]);
    }

    /**
     * Create a contact custom field value.
     *
     * @param  int  $contactId  Contact ID.
     * @param  int  $fieldId  Field ID.
     * @param  mixed  $value  Field value.
     * @return array<string, mixed>
     */
    public function createFieldValue(int $contactId, int $fieldId, mixed $value): array
    {
        return $this->request('POST', '/fieldValues', [
            'fieldValue' => [
                'contact' => $contactId,
                'field' => $fieldId,
                'value' => $value,
            ],
        ]);
    }

    /**
     * Update an existing contact custom field value.
     *
     * @param  int  $fieldValueId  Field value relationship ID.
     * @param  mixed  $value  New field value.
     * @return array<string, mixed>
     */
    public function updateFieldValue(int $fieldValueId, mixed $value): array
    {
        return $this->request('PUT', "/fieldValues/{$fieldValueId}", [
            'fieldValue' => [
                'value' => $value,
            ],
        ]);
    }

    // ── Deals ──────────────────────────────────────────────────────────

    /**
     * List deals with optional filters.
     *
     * @param  int|null    $limit     Number of results per page.
     * @param  int|null    $offset    Offset for pagination.
     * @param  string|null $search    Search term to filter deals.
     * @param  array       $filters   Additional query filters (e.g., pipeline, stage, status).
     * @return array The API response containing deals and meta.
     */
    public function listDeals(?int $limit = null, ?int $offset = null, ?string $search = null, array $filters = []): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }
        if ($search !== null) {
            $params['search'] = $search;
        }
        foreach ($filters as $key => $value) {
            $params[$key] = $value;
        }

        return $this->request('GET', '/deals', $params);
    }

    /**
     * Get a single deal by ID.
     *
     * @param  int   $dealId The deal ID.
     * @return array The API response containing the deal.
     */
    public function getDeal(int $dealId): array
    {
        return $this->request('GET', "/deals/{$dealId}");
    }

    /**
     * Create a new deal.
     *
     * @param  string   $title     The deal title.
     * @param  float    $value     The deal value (in cents or dollars depending on pipeline settings).
     * @param  int      $contactId The associated contact ID.
     * @param  int      $stage     The pipeline stage ID.
     * @param  int|null $pipeline  The pipeline ID (optional).
     * @param  array    $extra     Additional deal fields.
     * @return array    The API response containing the created deal.
     */
    public function createDeal(string $title, float $value, int $contactId, int $stage, ?int $pipeline = null, array $extra = []): array
    {
        $deal = array_merge([
            'title' => $title,
            'value' => $value,
            'contact' => $contactId,
            'stage' => $stage,
        ], $pipeline !== null ? ['pipeline' => $pipeline] : [], $extra);

        return $this->request('POST', '/deals', ['deal' => $deal]);
    }

    /**
     * Update an existing deal.
     *
     * @param  int   $dealId The deal ID to update.
     * @param  array $data   The deal fields to update.
     * @return array The API response containing the updated deal.
     */
    public function updateDeal(int $dealId, array $data): array
    {
        return $this->request('PUT', "/deals/{$dealId}", ['deal' => $data]);
    }

    /**
     * Delete a deal.
     *
     * @param  int  $dealId  Deal ID.
     * @return array<string, mixed>
     */
    public function deleteDeal(int $dealId): array
    {
        return $this->request('DELETE', "/deals/{$dealId}");
    }

    /**
     * List deal pipelines.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listDealGroups(array $params = []): array
    {
        return $this->request('GET', '/dealGroups', $params);
    }

    /**
     * List deal stages.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listDealStages(array $params = []): array
    {
        return $this->request('GET', '/dealStages', $params);
    }

    // ── Automations ────────────────────────────────────────────────────

    /**
     * List all automations in the account.
     *
     * @param  int|null $limit  Number of results per page.
     * @param  int|null $offset Offset for pagination.
     * @return array    The API response containing automations.
     */
    public function listAutomations(?int $limit = null, ?int $offset = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/automations', $params);
    }

    // ── Campaigns, Messages, and Accounts ──────────────────────────────

    /**
     * List campaigns.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCampaigns(array $params = []): array
    {
        return $this->request('GET', '/campaigns', $params);
    }

    /**
     * Retrieve a campaign.
     *
     * @param  int  $campaignId  Campaign ID.
     * @return array<string, mixed>
     */
    public function getCampaign(int $campaignId): array
    {
        return $this->request('GET', "/campaigns/{$campaignId}");
    }

    /**
     * List messages.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/messages', $params);
    }

    /**
     * List CRM accounts.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAccounts(array $params = []): array
    {
        return $this->request('GET', '/accounts', $params);
    }

    /**
     * Retrieve a CRM account.
     *
     * @param  int  $accountId  Account ID.
     * @return array<string, mixed>
     */
    public function getAccount(int $accountId): array
    {
        return $this->request('GET', "/accounts/{$accountId}");
    }

    /**
     * Create a CRM account.
     *
     * @param  array<string, mixed>  $account  Account payload.
     * @return array<string, mixed>
     */
    public function createAccount(array $account): array
    {
        return $this->request('POST', '/accounts', ['account' => $account]);
    }

    /**
     * Update a CRM account.
     *
     * @param  int  $accountId  Account ID.
     * @param  array<string, mixed>  $account  Account payload.
     * @return array<string, mixed>
     */
    public function updateAccount(int $accountId, array $account): array
    {
        return $this->request('PUT', "/accounts/{$accountId}", ['account' => $account]);
    }

    // ── Notes ──────────────────────────────────────────────────────────

    /**
     * Create a note on a contact.
     *
     * @param  int    $contactId The contact ID to attach the note to.
     * @param  string $noteText  The note content.
     * @return array  The API response containing the created note.
     */
    public function createNote(int $contactId, string $noteText): array
    {
        return $this->request('POST', '/notes', [
            'note' => [
                'note' => $noteText,
                'reltype' => 'Deal',
                'relid' => $contactId,
            ],
        ]);
    }

    // ── Test Connection ────────────────────────────────────────────────

    /**
     * Test the API connection by fetching the current user.
     *
     * @return array The API response containing user data.
     */
    public function testConnection(): array
    {
        return $this->getCurrentUser();
    }

    // ── Generic API escape hatch ───────────────────────────────────────

    /**
     * Send a GET request to an arbitrary ActiveCampaign API path.
     *
     * @param  string  $path  API path under /api/3.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to an arbitrary ActiveCampaign API path.
     *
     * @param  string  $path  API path under /api/3.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PUT request to an arbitrary ActiveCampaign API path.
     *
     * @param  string  $path  API path under /api/3.
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to an arbitrary ActiveCampaign API path.
     *
     * @param  string  $path  API path under /api/3.
     * @param  array<string, mixed>  $payload  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    // ── HTTP Layer ─────────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param  string $path   The API endpoint path (relative to base URL).
     * @param  array  $data   Query parameters (GET) or JSON body (POST/PUT/DELETE).
     * @return array  The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($method === 'DELETE' && $response->status() === 200) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the ActiveCampaign API.
     *
     * @param  string $method The HTTP method (GET, POST, PUT, DELETE).
     * @param  string $path   The API endpoint path.
     * @param  array  $data   Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->accountName) {
            throw new \RuntimeException('ActiveCampaign API key and account name are required.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Api-Token' => $this->apiKey,
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
                $error = $response->json('message') ?? $response->json('errors.0.title') ?? $response->body();
                Log::error("ActiveCampaign API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("ActiveCampaign API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("ActiveCampaign API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ActiveCampaign API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize a caller-supplied API path.
     */
    private function normalizePath(string $path): string
    {
        return '/'.ltrim($path, '/');
    }
}
