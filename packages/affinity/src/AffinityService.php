<?php

namespace OpenCompany\Integrations\Affinity;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Affinity CRM API service.
 *
 * Handles all HTTP communication with the Affinity REST API using
 * HTTP Basic authentication (API key as username, empty password).
 *
 * @see https://api.affinity.co
 */
class AffinityService
{
    /**
     * Create a new AffinityService instance.
     *
     * @param  string  $apiKey  The Affinity API key used for HTTP Basic auth.
     * @param  string  $baseUrl  The base URL for the Affinity API.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.affinity.co',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List contacts with optional pagination.
     *
     * @param  int  $limit  Maximum number of contacts to return (max 500).
     * @param  int|null  $page  Page number for cursor-based pagination.
     * @return array<string, mixed>
     */
    public function listContacts(int $limit = 100, ?int $page = null): array
    {
        $params = ['limit' => $limit];
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  int  $id  The Affinity contact ID.
     * @return array<string, mixed>
     */
    public function getContact(int $id): array
    {
        return $this->request('GET', '/contacts/' . $id);
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact fields (first_name, last_name, emails, etc.).
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', $data);
    }

    /**
     * List organizations with optional pagination.
     *
     * @param  int  $limit  Maximum number of organizations to return (max 500).
     * @param  int|null  $page  Page number for cursor-based pagination.
     * @return array<string, mixed>
     */
    public function listOrganizations(int $limit = 100, ?int $page = null): array
    {
        $params = ['limit' => $limit];
        if ($page !== null) {
            $params['page'] = $page;
        }

        return $this->request('GET', '/organizations', $params);
    }

    /**
     * Get a single organization by ID.
     *
     * @param  int  $id  The Affinity organization ID.
     * @return array<string, mixed>
     */
    public function getOrganization(int $id): array
    {
        return $this->request('GET', '/organizations/' . $id);
    }

    /**
     * Create a new organization.
     *
     * @param  array<string, mixed>  $data  Organization fields (name, domain, etc.).
     * @return array<string, mixed>
     */
    public function createOrganization(array $data): array
    {
        return $this->request('POST', '/organizations', $data);
    }

    /**
     * List all lists.
     *
     * @return array<string, mixed>
     */
    public function listLists(): array
    {
        return $this->request('GET', '/lists');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/auth/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Affinity API.
     *
     * Uses HTTP Basic authentication with the API key as the username
     * and an empty string as the password.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Affinity API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, '')
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Affinity API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Affinity API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Affinity API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Affinity API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Affinity API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Affinity API: {$e->getMessage()}");
        }
    }
}
