<?php

namespace OpenCompany\Integrations\ConstantContact;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for communicating with the Constant Contact v3 API.
 *
 * Handles authentication via Bearer token and provides methods for all
 * supported endpoints: contacts, campaigns, lists, and user info.
 */
class ConstantContactService
{
    /**
     * Create a new ConstantContactService instance.
     *
     * @param  string  $accessToken  The OAuth2 bearer token for API authentication.
     * @param  string  $baseUrl      The base URL for the Constant Contact API (default: https://api.cc.email/v3).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.cc.email/v3',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List contacts with optional pagination and status filtering.
     *
     * @param  int|null       $limit   Maximum number of contacts to return per page (default: 50, max: 500).
     * @param  string|null    $cursor  Pagination cursor from a previous response.
     * @param  string|null    $status  Filter by contact status: "all", "active", "unconfirmed", "opted_out", "non_subscriber".
     * @return array<string, mixed>
     */
    public function listContacts(?int $limit = null, ?string $cursor = null, ?string $status = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $contactId  The Constant Contact contact ID.
     * @return array<string, mixed>
     */
    public function getContact(string $contactId): array
    {
        return $this->request('GET', '/contacts/' . urlencode($contactId));
    }

    /**
     * Create a new contact.
     *
     * @param  string    $email       The contact's email address.
     * @param  string    $firstName   The contact's first name.
     * @param  string    $lastName    The contact's last name.
     * @param  array     $listIds     Array of list UUIDs to add the contact to.
     * @return array<string, mixed>
     */
    public function createContact(string $email, string $firstName = '', string $lastName = '', array $listIds = []): array
    {
        $body = [
            'email_address' => [
                'address' => $email,
                'permission_to_send' => 'implicit',
            ],
        ];

        if ($firstName !== '') {
            $body['first_name'] = $firstName;
        }
        if ($lastName !== '') {
            $body['last_name'] = $lastName;
        }
        if (!empty($listIds)) {
            $body['list_memberships'] = $listIds;
        }

        return $this->request('POST', '/contacts', $body);
    }

    /**
     * List email campaigns with optional pagination.
     *
     * @param  int|null     $limit   Maximum number of campaigns to return per page (default: 50).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array<string, mixed>
     */
    public function listCampaigns(?int $limit = null, ?string $cursor = null): array
    {
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/emails', $params);
    }

    /**
     * List all contact lists.
     *
     * @return array<string, mixed>
     */
    public function listLists(): array
    {
        return $this->request('GET', '/contact_lists');
    }

    /**
     * Get the current authenticated user's account information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string               $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string               $path    API endpoint path (relative to base URL).
     * @param  array<string, mixed> $data    Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Constant Contact API.
     *
     * @param  string               $method  HTTP method.
     * @param  string               $path    API endpoint path.
     * @param  array<string, mixed> $data    Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Constant Contact API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Constant Contact API endpoint not available (HTTP {$response->status()}). The URL may be incorrect or the service is experiencing issues.");
                }

                $error = $response->json();
                $errorMessage = is_array($error)
                    ? ($error[0]['error_message'] ?? json_encode($error))
                    : $body;

                Log::error("Constant Contact API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $errorMessage,
                ]);
                throw new \RuntimeException("Constant Contact API error ({$response->status()}): " . (is_string($errorMessage) ? $errorMessage : json_encode($errorMessage)));
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
