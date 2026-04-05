<?php

namespace OpenCompany\Integrations\HubSpot;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the HubSpot CRM REST API covering contacts, companies, deals, tickets, associations, and engagements.
 *
 * Wraps the HubSpot v3 CRM API with Bearer token authentication, request routing, and error reporting.
 */
class HubSpotService
{
    private const BASE_URL = 'https://api.hubapi.com';

    /**
     * @param  string  $accessToken  HubSpot private app access token
     */
    public function __construct(
        private string $accessToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->accessToken);
    }

    // ── Contacts ───────────────────────────────────────────

    /**
     * Create a contact.
     *
     * @param  array<string, mixed>  $properties  Key-value map of HubSpot contact properties
     * @return array<string, mixed>
     */
    public function createContact(array $properties): array
    {
        return $this->request('POST', '/crm/v3/objects/contacts', ['properties' => $properties]);
    }

    /**
     * Get a contact by ID.
     *
     * @param  array<string>|null  $properties  List of properties to include
     * @return array<string, mixed>
     */
    public function getContact(string $id, ?array $properties = null): array
    {
        $query = [];
        if ($properties !== null) {
            $query['properties'] = implode(',', $properties);
        }

        return $this->request('GET', "/crm/v3/objects/contacts/{$id}", $query);
    }

    /**
     * Update a contact by ID.
     *
     * @param  array<string, mixed>  $properties  Key-value map of properties to update
     * @return array<string, mixed>
     */
    public function updateContact(string $id, array $properties): array
    {
        return $this->request('PATCH', "/crm/v3/objects/contacts/{$id}", ['properties' => $properties]);
    }

    /**
     * Delete a contact by ID.
     *
     * @return array<string, mixed>
     */
    public function deleteContact(string $id): array
    {
        return $this->request('DELETE', "/crm/v3/objects/contacts/{$id}");
    }

    /**
     * Search contacts using filter groups and/or text query.
     *
     * @param  array<string, mixed>  $body  Search body with filterGroups, properties, limit, after
     * @return array<string, mixed>
     */
    public function searchContacts(array $body = []): array
    {
        return $this->request('POST', '/crm/v3/objects/contacts/search', $body);
    }

    // ── Companies ──────────────────────────────────────────

    /**
     * Create a company.
     *
     * @param  array<string, mixed>  $properties  Key-value map of HubSpot company properties
     * @return array<string, mixed>
     */
    public function createCompany(array $properties): array
    {
        return $this->request('POST', '/crm/v3/objects/companies', ['properties' => $properties]);
    }

    /**
     * Get a company by ID.
     *
     * @param  array<string>|null  $properties  List of properties to include
     * @return array<string, mixed>
     */
    public function getCompany(string $id, ?array $properties = null): array
    {
        $query = [];
        if ($properties !== null) {
            $query['properties'] = implode(',', $properties);
        }

        return $this->request('GET', "/crm/v3/objects/companies/{$id}", $query);
    }

    /**
     * Update a company by ID.
     *
     * @param  array<string, mixed>  $properties  Key-value map of properties to update
     * @return array<string, mixed>
     */
    public function updateCompany(string $id, array $properties): array
    {
        return $this->request('PATCH', "/crm/v3/objects/companies/{$id}", ['properties' => $properties]);
    }

    /**
     * Search companies using filter groups and/or text query.
     *
     * @param  array<string, mixed>  $body  Search body with filterGroups, properties, limit, after
     * @return array<string, mixed>
     */
    public function searchCompanies(array $body = []): array
    {
        return $this->request('POST', '/crm/v3/objects/companies/search', $body);
    }

    // ── Deals ──────────────────────────────────────────────

    /**
     * Create a deal.
     *
     * @param  array<string, mixed>  $properties  Key-value map of HubSpot deal properties
     * @return array<string, mixed>
     */
    public function createDeal(array $properties): array
    {
        return $this->request('POST', '/crm/v3/objects/deals', ['properties' => $properties]);
    }

    /**
     * Get a deal by ID.
     *
     * @param  array<string>|null  $properties  List of properties to include
     * @return array<string, mixed>
     */
    public function getDeal(string $id, ?array $properties = null): array
    {
        $query = [];
        if ($properties !== null) {
            $query['properties'] = implode(',', $properties);
        }

        return $this->request('GET', "/crm/v3/objects/deals/{$id}", $query);
    }

    /**
     * Update a deal by ID.
     *
     * @param  array<string, mixed>  $properties  Key-value map of properties to update
     * @return array<string, mixed>
     */
    public function updateDeal(string $id, array $properties): array
    {
        return $this->request('PATCH', "/crm/v3/objects/deals/{$id}", ['properties' => $properties]);
    }

    /**
     * List deals with optional pagination.
     *
     * @param  array<string, mixed>  $params  Query params: limit, after, properties
     * @return array<string, mixed>
     */
    public function listDeals(array $params = []): array
    {
        return $this->request('GET', '/crm/v3/objects/deals', $params);
    }

    // ── Tickets ────────────────────────────────────────────

    /**
     * Create a ticket.
     *
     * @param  array<string, mixed>  $properties  Key-value map of HubSpot ticket properties
     * @return array<string, mixed>
     */
    public function createTicket(array $properties): array
    {
        return $this->request('POST', '/crm/v3/objects/tickets', ['properties' => $properties]);
    }

    /**
     * Get a ticket by ID.
     *
     * @param  array<string>|null  $properties  List of properties to include
     * @return array<string, mixed>
     */
    public function getTicket(string $id, ?array $properties = null): array
    {
        $query = [];
        if ($properties !== null) {
            $query['properties'] = implode(',', $properties);
        }

        return $this->request('GET', "/crm/v3/objects/tickets/{$id}", $query);
    }

    /**
     * Update a ticket by ID.
     *
     * @param  array<string, mixed>  $properties  Key-value map of properties to update
     * @return array<string, mixed>
     */
    public function updateTicket(string $id, array $properties): array
    {
        return $this->request('PATCH', "/crm/v3/objects/tickets/{$id}", ['properties' => $properties]);
    }

    // ── Associations ───────────────────────────────────────

    /**
     * Create an association between two CRM objects.
     *
     * @return array<string, mixed>
     */
    public function createAssociation(
        string $fromType,
        string $fromId,
        string $toType,
        string $toId,
        string $associationType,
    ): array {
        return $this->request(
            'PUT',
            "/crm/v3/objects/{$fromType}/{$fromId}/associations/{$toType}/{$toId}/{$associationType}",
        );
    }

    /**
     * List associations from one CRM object to another object type.
     *
     * @return array<string, mixed>
     */
    public function listAssociations(
        string $fromType,
        string $fromId,
        string $toType,
    ): array {
        return $this->request(
            'GET',
            "/crm/v3/objects/{$fromType}/{$fromId}/associations/{$toType}",
        );
    }

    // ── Owners ─────────────────────────────────────────────

    /**
     * List CRM owners (users).
     *
     * @param  array<string, mixed>  $params  Query params: limit, after
     * @return array<string, mixed>
     */
    public function listOwners(array $params = []): array
    {
        return $this->request('GET', '/crm/v3/owners', $params);
    }

    // ── Engagements ────────────────────────────────────────

    /**
     * Create an engagement (note, task, or meeting).
     *
     * @param  string  $type  One of: notes, tasks, meetings
     * @param  array<string, mixed>  $properties  Key-value map of engagement properties
     * @return array<string, mixed>
     */
    public function createEngagement(string $type, array $properties): array
    {
        return $this->request('POST', "/crm/v3/objects/{$type}", ['properties' => $properties]);
    }

    // ── Pipelines ──────────────────────────────────────────

    /**
     * List pipelines for a given object type.
     *
     * @return array<string, mixed>
     */
    public function listPipelines(string $objectType): array
    {
        return $this->request('GET', "/crm/v3/pipelines/{$objectType}");
    }

    // ── Properties ─────────────────────────────────────────

    /**
     * List property definitions for a given object type.
     *
     * @return array<string, mixed>
     */
    public function listProperties(string $objectType): array
    {
        return $this->request('GET', "/crm/v3/properties/{$objectType}");
    }

    // ── Lists ──────────────────────────────────────────────

    /**
     * Add contacts to a HubSpot list.
     *
     * @param  array<string>|null  $contactIds  List of contact vid IDs
     * @param  array<string>|null  $emails  List of email addresses
     * @return array<string, mixed>
     */
    public function addContactToList(string $listId, ?array $contactIds = null, ?array $emails = null): array
    {
        $body = [];
        if ($contactIds !== null) {
            $body['vids'] = $contactIds;
        }
        if ($emails !== null) {
            $body['emails'] = $emails;
        }

        return $this->request('POST', "/contacts/v1/lists/{$listId}/add", $body);
    }

    // ── Forms ──────────────────────────────────────────────

    /**
     * List marketing forms.
     *
     * @param  array<string, mixed>  $params  Query params: limit, after
     * @return array<string, mixed>
     */
    public function listForms(array $params = []): array
    {
        return $this->request('GET', '/marketing/v3/forms/', $params);
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request.
     *
     * @param  array<string, mixed>  $data  Query params (GET) or JSON body (POST/PATCH/PUT/DELETE)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->accessToken) {
            throw new \RuntimeException('HubSpot access token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get(self::BASE_URL . $path, $data),
                'POST' => $http->post(self::BASE_URL . $path, $data),
                'PUT' => $http->put(self::BASE_URL . $path, $data),
                'PATCH' => $http->patch(self::BASE_URL . $path, $data),
                'DELETE' => $http->delete(self::BASE_URL . $path, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['message'] ?? $response->body();

                Log::error("HubSpot API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => is_string($err) ? $err : json_encode($err),
                ]);

                $msg = is_string($err) ? $err : json_encode($err);

                throw new \RuntimeException('HubSpot API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("HubSpot API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to HubSpot API: {$e->getMessage()}");
        }
    }
}
