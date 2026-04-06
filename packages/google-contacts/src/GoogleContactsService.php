<?php

namespace OpenCompany\Integrations\GoogleContacts;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Google Contacts (People API) service.
 *
 * Handles authentication and HTTP communication with the Google People API.
 * Supports listing/getting/creating contacts, managing contact groups,
 * accessing "Other Contacts", and retrieving the current user profile.
 *
 * @see https://developers.google.com/people/api/rest/v1
 */
class GoogleContactsService
{
    /**
     * Create a new GoogleContactsService instance.
     *
     * @param  string  $accessToken  OAuth2 access token for the Google People API.
     * @param  string  $baseUrl      Base URL for the People API (defaults to https://people.googleapis.com).
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://people.googleapis.com',
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
     * List the authenticated user's contacts (connections).
     *
     * @param  int         $pageSize   Number of connections to include in the response (1–2000, default 200).
     * @param  string|null $pageToken  Token to retrieve a specific page of results.
     * @param  string|null $sortOrder  Order in which connections are sorted ("LAST_NAME_ASCENDING" or "LAST_NAME_DESCENDING").
     * @param  string|null $syncToken  Sync token from a previous list call to return only changed contacts.
     * @return array<string, mixed>
     *
     * @see https://developers.google.com/people/api/rest/v1/people.connections/list
     */
    public function listConnections(int $pageSize = 200, ?string $pageToken = null, ?string $sortOrder = null, ?string $syncToken = null): array
    {
        $params = [
            'pageSize' => $pageSize,
            'personFields' => 'names,emailAddresses,phoneNumbers,biographies,organizations,photos',
        ];

        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }
        if ($sortOrder !== null) {
            $params['sortOrder'] = $sortOrder;
        }
        if ($syncToken !== null) {
            $params['syncToken'] = $syncToken;
        }

        return $this->request('GET', '/v1/people/me/connections', $params);
    }

    /**
     * Get a specific contact (connection) by resource name.
     *
     * @param  string  $resourceName   The resource name of the person (e.g., "people/c123456789").
     * @param  string  $personFields   Comma-separated list of person fields to include.
     * @return array<string, mixed>
     *
     * @see https://developers.google.com/people/api/rest/v1/people/get
     */
    public function getConnection(string $resourceName, string $personFields = 'names,emailAddresses,phoneNumbers,biographies,organizations,photos'): array
    {
        $path = '/v1/' . urlencode($resourceName);

        return $this->request('GET', $path, [
            'personFields' => $personFields,
        ]);
    }

    /**
     * Create a new contact in the authenticated user's "myContacts" group.
     *
     * @param  array<int, array<string, mixed>>  $names          Contact names (e.g., [["givenName" => "John", "familyName" => "Doe"]]).
     * @param  array<int, array<string, mixed>>  $emailAddresses Email addresses (e.g., [["value" => "john@example.com"]]).
     * @param  array<int, array<string, mixed>>  $phoneNumbers   Phone numbers (e.g., [["value" => "+1234567890"]]).
     * @param  array<int, array<string, mixed>>  $biographies    Biographies / notes (e.g., [["value" => "Met at conference"]]).
     * @return array<string, mixed>
     *
     * @see https://developers.google.com/people/api/rest/v1/people/createContact
     */
    public function createContact(array $names = [], array $emailAddresses = [], array $phoneNumbers = [], array $biographies = []): array
    {
        $body = [];

        if (!empty($names)) {
            $body['names'] = $names;
        }
        if (!empty($emailAddresses)) {
            $body['emailAddresses'] = $emailAddresses;
        }
        if (!empty($phoneNumbers)) {
            $body['phoneNumbers'] = $phoneNumbers;
        }
        if (!empty($biographies)) {
            $body['biographies'] = $biographies;
        }

        return $this->request('POST', '/v1/people:createContact', $body);
    }

    /**
     * List all contact groups owned by the authenticated user.
     *
     * @param  int         $pageSize   Number of groups to return (1–2000, default 10).
     * @param  string|null $pageToken  Token to retrieve a specific page of results.
     * @param  string|null $syncToken  Sync token from a previous list call.
     * @return array<string, mixed>
     *
     * @see https://developers.google.com/people/api/rest/v1/contactGroups/list
     */
    public function listContactGroups(int $pageSize = 200, ?string $pageToken = null, ?string $syncToken = null): array
    {
        $params = [
            'pageSize' => $pageSize,
            'groupFields' => 'name,groupType,memberCount',
        ];

        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }
        if ($syncToken !== null) {
            $params['syncToken'] = $syncToken;
        }

        return $this->request('GET', '/v1/contactGroups', $params);
    }

    /**
     * Get a specific contact group by resource name.
     *
     * @param  string  $resourceName  The resource name of the contact group (e.g., "contactGroups/myContacts").
     * @return array<string, mixed>
     *
     * @see https://developers.google.com/people/api/rest/v1/contactGroups/get
     */
    public function getContactGroup(string $resourceName): array
    {
        $path = '/v1/' . urlencode($resourceName);

        return $this->request('GET', $path, [
            'groupFields' => 'name,groupType,memberCount,memberResourceNames',
        ]);
    }

    /**
     * List "Other Contacts" — contacts the user has interacted with but not added to a group.
     *
     * @param  int         $pageSize   Number of contacts to return (1–1000, default 20).
     * @param  string|null $pageToken  Token to retrieve a specific page of results.
     * @param  string|null $syncToken  Sync token from a previous list call.
     * @return array<string, mixed>
     *
     * @see https://developers.google.com/people/api/rest/v1/otherContacts/list
     */
    public function listOtherContacts(int $pageSize = 200, ?string $pageToken = null, ?string $syncToken = null): array
    {
        $params = [
            'pageSize' => $pageSize,
            'readMask' => 'names,emailAddresses,phoneNumbers',
        ];

        if ($pageToken !== null) {
            $params['pageToken'] = $pageToken;
        }
        if ($syncToken !== null) {
            $params['syncToken'] = $syncToken;
        }

        return $this->request('GET', '/v1/otherContacts', $params);
    }

    /**
     * Get the authenticated user's profile information.
     *
     * @return array<string, mixed>
     *
     * @see https://developers.google.com/people/api/rest/v1/people/get
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/people/me', [
            'personFields' => 'names,emailAddresses,photos',
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string               $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string               $path    API path (e.g., "/v1/people/me/connections").
     * @param  array<string, mixed> $data    Query parameters (GET) or JSON body (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Google People API.
     *
     * @param  string               $method  HTTP method.
     * @param  string               $path    API path.
     * @param  array<string, mixed> $data    Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the access token is missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Google Contacts access token is not configured.');
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
                $json = $response->json();
                $error = $json['error']['message'] ?? $response->body();

                Log::error("Google Contacts API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Google Contacts API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Google Contacts API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Google Contacts API: {$e->getMessage()}");
        }
    }
}
