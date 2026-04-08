<?php

namespace OpenCompany\Integrations\Capsule;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * CapsuleService — HTTP client for the Capsule CRM API v2.
 *
 * Handles authentication via Bearer token, configurable base URL,
 * and provides methods for contacts (parties), opportunities, tasks,
 * and the current user endpoint.
 */
class CapsuleService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.capsulecrm.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an access token configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    // -------------------------------------------------------
    // Contacts (Parties)
    // -------------------------------------------------------

    /**
     * List contacts (parties) with pagination.
     *
     * @param  int  $page     The page number (1-based).
     * @param  int  $perPage  Number of results per page (max 100).
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $perPage = 50): array
    {
        return $this->request('GET', '/parties', [
            'page' => $page,
            'perPage' => $perPage,
        ]);
    }

    /**
     * Get a single contact (party) by ID.
     *
     * @param  int  $id  The party ID.
     * @return array<string, mixed>
     */
    public function getContact(int $id): array
    {
        return $this->request('GET', '/parties/' . $id);
    }

    /**
     * Create a new contact (party).
     *
     * @param  string  $type            Either "person" or "organisation".
     * @param  string  $firstName       First name (required for persons).
     * @param  string  $lastName        Last name (required for persons).
     * @param  array   $emailAddresses  List of email address hashes, e.g. [{"address":"a@b.com"}].
     * @return array<string, mixed>
     */
    public function createContact(
        string $type = 'person',
        string $firstName = '',
        string $lastName = '',
        array $emailAddresses = [],
    ): array {
        $party = [
            'type' => $type,
        ];

        if ($firstName !== '') {
            $party['firstName'] = $firstName;
        }

        if ($lastName !== '') {
            $party['lastName'] = $lastName;
        }

        if (!empty($emailAddresses)) {
            $party['emailAddresses'] = $emailAddresses;
        }

        return $this->request('POST', '/parties', [
            'party' => $party,
        ]);
    }

    // -------------------------------------------------------
    // Opportunities
    // -------------------------------------------------------

    /**
     * List opportunities with optional filtering by status.
     *
     * @param  int       $page     The page number (1-based).
     * @param  int       $perPage  Number of results per page (max 100).
     * @param  string|null  $status  Filter by status (e.g. "OPEN", "WON", "LOST", "CLOSED").
     * @return array<string, mixed>
     */
    public function listOpportunities(int $page = 1, int $perPage = 50, ?string $status = null): array
    {
        $params = [
            'page' => $page,
            'perPage' => $perPage,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/opportunities', $params);
    }

    /**
     * Get a single opportunity by ID.
     *
     * @param  int  $id  The opportunity ID.
     * @return array<string, mixed>
     */
    public function getOpportunity(int $id): array
    {
        return $this->request('GET', '/opportunities/' . $id);
    }

    // -------------------------------------------------------
    // Tasks
    // -------------------------------------------------------

    /**
     * List tasks with optional filtering by status.
     *
     * @param  int       $page     The page number (1-based).
     * @param  int       $perPage  Number of results per page (max 100).
     * @param  string|null  $status  Filter by status (e.g. "OPEN", "COMPLETED").
     * @return array<string, mixed>
     */
    public function listTasks(int $page = 1, int $perPage = 50, ?string $status = null): array
    {
        $params = [
            'page' => $page,
            'perPage' => $perPage,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/tasks', $params);
    }

    // -------------------------------------------------------
    // Current User
    // -------------------------------------------------------

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // -------------------------------------------------------
    // HTTP helpers
    // -------------------------------------------------------

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path relative to base URL (e.g. "/parties").
     * @param  array   $data    Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($method === 'DELETE' && $response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Capsule CRM API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array   $data    Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Capsule CRM access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->body();
                Log::error("Capsule CRM API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Capsule CRM API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Capsule CRM API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Capsule CRM API: {$e->getMessage()}");
        }
    }
}
