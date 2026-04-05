<?php

namespace OpenCompany\Integrations\ConstantContact;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Constant Contact API service for interacting with the Constant Contact v3 REST API.
 *
 * Handles authentication via Bearer token, HTTP requests, error handling,
 * and response parsing for all Constant Contact endpoints.
 */
class ConstantContactService
{
    /**
     * Create a new ConstantContactService instance.
     *
     * @param  string  $accessToken  Constant Contact OAuth2 access token
     * @param  string  $baseUrl  Base URL for the Constant Contact API
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.cc.email/v3',
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
     * List contacts with optional filtering.
     *
     * @param  int  $limit  Maximum number of contacts to return (max 500, default 100)
     * @param  string|null  $status  Filter by status: "active", "unconfirmed", "opted_out", "pending"
     * @return array<string, mixed> Paginated contact results
     */
    public function listContacts(int $limit = 100, ?string $status = null): array
    {
        $params = ['limit' => min($limit, 500)];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a single contact by their Constant Contact contact ID.
     *
     * @param  string  $contactId  The Constant Contact contact ID
     * @return array<string, mixed> Contact data
     */
    public function getContact(string $contactId): array
    {
        return $this->request('GET', '/contacts/' . urlencode($contactId));
    }

    /**
     * Create a new contact in Constant Contact.
     *
     * @param  string  $email  Contact email address
     * @param  string|null  $firstName  Optional first name
     * @param  string|null  $lastName  Optional last name
     * @param  array<int, string>  $listIds  Optional list IDs to add the contact to
     * @return array<string, mixed> Created contact data
     */
    public function createContact(string $email, ?string $firstName = null, ?string $lastName = null, array $listIds = []): array
    {
        $data = [
            'email_address' => ['address' => $email],
        ];

        if ($firstName !== null) {
            $data['first_name'] = $firstName;
        }

        if ($lastName !== null) {
            $data['last_name'] = $lastName;
        }

        if (!empty($listIds)) {
            $data['list_memberships'] = $listIds;
        }

        return $this->request('POST', '/contacts', $data);
    }

    /**
     * Update an existing contact in Constant Contact.
     *
     * @param  string  $contactId  The Constant Contact contact ID
     * @param  array<string, mixed>  $data  Fields to update
     * @return array<string, mixed> Updated contact data
     */
    public function updateContact(string $contactId, array $data): array
    {
        return $this->request('PUT', '/contacts/' . urlencode($contactId), $data);
    }

    /**
     * Delete a contact from Constant Contact.
     *
     * @param  string  $contactId  The Constant Contact contact ID
     */
    public function deleteContact(string $contactId): void
    {
        $this->request('DELETE', '/contacts/' . urlencode($contactId));
    }

    /**
     * List all contact lists in the account.
     *
     * @return array<string, mixed> List of contact lists
     */
    public function listLists(): array
    {
        return $this->request('GET', '/contact_lists');
    }

    /**
     * Get a single contact list by ID.
     *
     * @param  string  $listId  The Constant Contact list ID
     * @return array<string, mixed> Contact list data
     */
    public function getList(string $listId): array
    {
        return $this->request('GET', '/contact_lists/' . urlencode($listId));
    }

    /**
     * Create a new contact list.
     *
     * @param  string  $name  The list name
     * @return array<string, mixed> Created list data
     */
    public function createList(string $name): array
    {
        return $this->request('POST', '/contact_lists', [
            'name' => $name,
        ]);
    }

    /**
     * Add contacts to a contact list.
     *
     * @param  string  $listId  The list ID
     * @param  array<int, string>  $contactIds  Array of contact IDs to add
     * @return array<string, mixed> Result of the add operation
     */
    public function addContactToList(string $listId, array $contactIds): array
    {
        return $this->request('POST', '/contact_lists/' . urlencode($listId) . '/contacts', [
            'contact_ids' => $contactIds,
        ]);
    }

    /**
     * Get the current user account summary.
     *
     * @return array<string, mixed> Account summary data
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/account/summary');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API endpoint path (relative to base URL)
     * @param  array<string, mixed>  $data  Request data (query params for GET, body for POST)
     * @return array<string, mixed> Parsed JSON response
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Constant Contact API.
     *
     * Attaches the Bearer access token on every request.
     * Handles error responses, HTML bodies, and connection failures.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API endpoint path
     * @param  array<string, mixed>  $data  Request payload
     * @return \Illuminate\Http\Client\Response Raw HTTP response
     *
     * @throws \RuntimeException On auth, connection, or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Constant Contact access token is not configured.');
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
                    Log::warning("Constant Contact API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Constant Contact API returned unexpected HTML (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Constant Contact API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Constant Contact API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Constant Contact API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Constant Contact API: {$e->getMessage()}");
        }
    }
}
