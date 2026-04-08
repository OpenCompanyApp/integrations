<?php

namespace OpenCompany\Integrations\Aircall;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Aircall API service for making authenticated requests to the Aircall REST API.
 *
 * Handles HTTP communication with the Aircall API including authentication via
 * Bearer tokens, request/response processing, and error handling.
 *
 * @see https://developer.aircall.io/
 */
class AircallService
{
    /**
     * Create a new AircallService instance.
     *
     * @param  string  $accessToken  The OAuth access token for API authentication.
     * @param  string  $baseUrl  The base URL for the Aircall API (default: https://api.aircall.io/v1).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.aircall.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Aircall integration is properly configured.
     *
     * Returns true when a non-empty access token has been provided.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    // --------------------------------------------------------------------------
    // Calls
    // --------------------------------------------------------------------------

    /**
     * List calls with optional filters and pagination.
     *
     * @param  array  $filters  Query parameters such as `per_page`, `page`, `order`, `from`, `to`, `direction`, etc.
     * @return array<string, mixed> The parsed JSON response containing calls data.
     *
     * @see https://developer.aircall.io/api-references/#list-calls
     */
    public function listCalls(array $filters = []): array
    {
        return $this->request('GET', '/calls', $filters);
    }

    /**
     * Retrieve a single call by its ID.
     *
     * @param  int  $callId  The unique identifier of the call.
     * @return array<string, mixed> The parsed JSON response containing the call data.
     *
     * @see https://developer.aircall.io/api-references/#retrieve-a-call
     */
    public function getCall(int $callId): array
    {
        return $this->request('GET', '/calls/' . $callId);
    }

    // --------------------------------------------------------------------------
    // Contacts
    // --------------------------------------------------------------------------

    /**
     * List contacts with optional filters and pagination.
     *
     * @param  array  $filters  Query parameters such as `per_page`, `page`, `order`, `q` (search), etc.
     * @return array<string, mixed> The parsed JSON response containing contacts data.
     *
     * @see https://developer.aircall.io/api-references/#list-contacts
     */
    public function listContacts(array $filters = []): array
    {
        return $this->request('GET', '/contacts', $filters);
    }

    /**
     * Create a new contact in Aircall.
     *
     * @param  array  $data  Contact fields: `first_name`, `last_name`, `company_name`, `information`, `phone_numbers`, `emails`, etc.
     * @return array<string, mixed> The parsed JSON response containing the created contact.
     *
     * @see https://developer.aircall.io/api-references/#create-a-contact
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', $data);
    }

    /**
     * Update an existing contact in Aircall.
     *
     * @param  int  $contactId  The unique identifier of the contact to update.
     * @param  array  $data  Contact fields to update: `first_name`, `last_name`, `company_name`, `information`, `phone_numbers`, `emails`, etc.
     * @return array<string, mixed> The parsed JSON response containing the updated contact.
     *
     * @see https://developer.aircall.io/api-references/#update-a-contact
     */
    public function updateContact(int $contactId, array $data): array
    {
        return $this->request('PUT', '/contacts/' . $contactId, $data);
    }

    // --------------------------------------------------------------------------
    // Users
    // --------------------------------------------------------------------------

    /**
     * List all users in the Aircall account.
     *
     * @return array<string, mixed> The parsed JSON response containing users data.
     *
     * @see https://developer.aircall.io/api-references/#list-users
     */
    public function listUsers(): array
    {
        return $this->request('GET', '/users');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The parsed JSON response containing the current user data.
     *
     * @see https://developer.aircall.io/api-references/#retrieve-the-current-user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // --------------------------------------------------------------------------
    // Numbers
    // --------------------------------------------------------------------------

    /**
     * List all phone numbers in the Aircall account.
     *
     * @return array<string, mixed> The parsed JSON response containing numbers data.
     *
     * @see https://developer.aircall.io/api-references/#list-numbers
     */
    public function listNumbers(): array
    {
        return $this->request('GET', '/numbers');
    }

    // --------------------------------------------------------------------------
    // HTTP layer
    // --------------------------------------------------------------------------

    /**
     * Make an authenticated API request and return parsed JSON.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path (e.g., "/calls").
     * @param  array  $data  Request body (POST/PUT) or query parameters (GET).
     * @return array<string, mixed> The parsed JSON response body.
     *
     * @throws \RuntimeException When the API returns an error or the service is not configured.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Aircall API.
     *
     * @param  string  $method  The HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  The API endpoint path.
     * @param  array  $data  Request body or query parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When the access token is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Aircall access token is not configured.');
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
                    Log::warning("Aircall API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Aircall API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Aircall API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Aircall API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Aircall API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Aircall API: {$e->getMessage()}");
        }
    }
}
