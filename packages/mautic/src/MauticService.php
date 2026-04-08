<?php

namespace OpenCompany\Integrations\Mautic;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * MauticService — HTTP client for the Mautic REST API.
 *
 * Communicates with a Mautic instance using HTTP Basic authentication
 * (username + password) and returns parsed JSON responses.
 *
 * @see https://developer.mautic.org/#rest-api
 */
class MauticService
{
    /**
     * Create a new MauticService instance.
     *
     * @param  string  $username  Mautic API username.
     * @param  string  $password  Mautic API password.
     * @param  string  $baseUrl   Base URL of the Mautic instance (e.g. "https://mautic.example.com").
     */
    public function __construct(
        private string $username = '',
        private string $password = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Determine whether the service has enough credentials to make requests.
     */
    public function isConfigured(): bool
    {
        return !empty($this->username) && !empty($this->password) && !empty($this->baseUrl);
    }

    /**
     * List contacts with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. search, limit, orderBy).
     * @return array<string, mixed>  Parsed JSON response containing contacts and metadata.
     *
     * @see https://developer.mautic.org/#get-contact-list
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/api/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  int|string  $id  The contact ID.
     * @return array<string, mixed>  Parsed JSON response containing the contact.
     *
     * @see https://developer.mautic.org/#get-contact
     */
    public function getContact(int|string $id): array
    {
        return $this->request('GET', '/api/contacts/' . urlencode((string) $id));
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact fields (e.g. email, firstname, lastname, company, etc.).
     * @return array<string, mixed>  Parsed JSON response containing the created contact.
     *
     * @see https://developer.mautic.org/#create-contact
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/api/contacts/new', $data);
    }

    /**
     * Update an existing contact.
     *
     * @param  int|string  $id    The contact ID.
     * @param  array<string, mixed>  $data  Contact fields to update.
     * @return array<string, mixed>  Parsed JSON response containing the updated contact.
     *
     * @see https://developer.mautic.org/#edit-contact
     */
    public function updateContact(int|string $id, array $data): array
    {
        return $this->request('PUT', '/api/contacts/' . urlencode((string) $id) . '/edit', $data);
    }

    /**
     * Delete a contact by ID.
     *
     * @param  int|string  $id  The contact ID.
     *
     * @see https://developer.mautic.org/#delete-contact
     */
    public function deleteContact(int|string $id): void
    {
        $this->request('DELETE', '/api/contacts/' . urlencode((string) $id) . '/delete');
    }

    /**
     * List emails (marketing emails / newsletters).
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. search, limit, orderBy).
     * @return array<string, mixed>  Parsed JSON response containing emails and metadata.
     *
     * @see https://developer.mautic.org/#get-email-list
     */
    public function listEmails(array $params = []): array
    {
        return $this->request('GET', '/api/emails', $params);
    }

    /**
     * List segments (contact lists / segments).
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. search, limit, orderBy).
     * @return array<string, mixed>  Parsed JSON response containing segments and metadata.
     *
     * @see https://developer.mautic.org/#get-segment-list
     */
    public function listSegments(array $params = []): array
    {
        return $this->request('GET', '/api/segments', $params);
    }

    /**
     * List forms.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g. search, limit, orderBy).
     * @return array<string, mixed>  Parsed JSON response containing forms and metadata.
     *
     * @see https://developer.mautic.org/#get-form-list
     */
    public function listForms(array $params = []): array
    {
        return $this->request('GET', '/api/forms', $params);
    }

    /**
     * Get the currently authenticated Mautic user.
     *
     * @return array<string, mixed>  Parsed JSON response containing the user.
     *
     * @see https://developer.mautic.org/#get-self-user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. "/api/contacts").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>  Parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Mautic REST API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. "/api/contacts").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response  Raw HTTP response.
     *
     * @throws \RuntimeException  When credentials are missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Mautic integration is not configured. Username, password, and hostname are required.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->username, $this->password)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

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

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Mautic API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Mautic API endpoint not available (HTTP {$response->status()}). Check the hostname and credentials.");
                }

                $error = $response->json('errors') ?? $response->json('error') ?? $body;
                Log::error("Mautic API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Mautic API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mautic API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mautic API: {$e->getMessage()}");
        }
    }
}
