<?php

namespace OpenCompany\Integrations\Okta;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OktaService
{
    public function __construct(
        private string $apiToken = '',
        private string $domain = '',
    ) {
        $this->domain = rtrim($this->domain, '/');
    }

    /**
     * Check whether the Okta integration is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken) && !empty($this->domain);
    }

    /**
     * Build the base URL for Okta API requests.
     */
    private function baseUrl(): string
    {
        return 'https://' . $this->domain . '/api/v1';
    }

    /**
     * List users in the Okta organization.
     *
     * @param  int  $limit  Maximum number of users to return (1–200, default 200).
     * @param  string|null  $q  Search query to filter users by name or email.
     * @return array<string, mixed>
     */
    public function listUsers(int $limit = 200, ?string $q = null): array
    {
        $params = ['limit' => min($limit, 200)];
        if ($q !== null) {
            $params['q'] = $q;
        }

        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a single user by ID or login.
     *
     * @param  string  $id  The user ID or login (email).
     * @return array<string, mixed>
     */
    public function getUser(string $id): array
    {
        return $this->request('GET', '/users/' . urlencode($id));
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Create a new user in Okta.
     *
     * @param  array<string, mixed>  $profile  User profile attributes (firstName, lastName, email, login, etc.).
     * @param  array<string, mixed>  $credentials  User credentials (password, provider, etc.).
     * @param  bool  $activate  Whether to activate the user immediately (default: true).
     * @return array<string, mixed>
     */
    public function createUser(array $profile, array $credentials = [], bool $activate = true): array
    {
        $body = [
            'profile' => $profile,
            'credentials' => !empty($credentials) ? $credentials : null,
        ];

        $params = ['activate' => $activate ? 'true' : 'false'];

        return $this->request('POST', '/users', $params, array_filter($body));
    }

    /**
     * Update an existing user's profile.
     *
     * @param  string  $id  The user ID or login.
     * @param  array<string, mixed>  $profile  Updated profile attributes.
     * @param  array<string, mixed>  $credentials  Updated credentials (optional).
     * @return array<string, mixed>
     */
    public function updateUser(string $id, array $profile, array $credentials = []): array
    {
        $body = ['profile' => $profile];
        if (!empty($credentials)) {
            $body['credentials'] = $credentials;
        }

        return $this->request('PUT', '/users/' . urlencode($id), [], $body);
    }

    /**
     * Deactivate a user.
     *
     * @param  string  $id  The user ID or login.
     */
    public function deactivateUser(string $id): void
    {
        $this->request('POST', '/users/' . urlencode($id) . '/lifecycle/deactivate');
    }

    /**
     * List groups in the Okta organization.
     *
     * @param  string|null  $q  Search query to filter groups by name.
     * @return array<string, mixed>
     */
    public function listGroups(?string $q = null): array
    {
        $params = [];
        if ($q !== null) {
            $params['q'] = $q;
        }

        return $this->request('GET', '/groups', $params);
    }

    /**
     * Get a single group by ID.
     *
     * @param  string  $id  The group ID.
     * @return array<string, mixed>
     */
    public function getGroup(string $id): array
    {
        return $this->request('GET', '/groups/' . urlencode($id));
    }

    /**
     * Add a user to a group.
     *
     * @param  string  $groupId  The group ID.
     * @param  string  $userId  The user ID.
     */
    public function addUserToGroup(string $groupId, string $userId): void
    {
        $this->request('PUT', '/groups/' . urlencode($groupId) . '/users/' . urlencode($userId));
    }

    /**
     * List applications in the Okta organization.
     *
     * @return array<string, mixed>
     */
    public function listApplications(): array
    {
        return $this->request('GET', '/apps');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g., /users).
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>|null  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], ?array $body = null): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Okta API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>|null  $body  JSON request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], ?array $body = null): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken || !$this->domain) {
            throw new \RuntimeException('Okta API token and domain are not configured.');
        }

        $url = $this->baseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'SSWS ' . $this->apiToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($url, array_merge($query, $body ?? [])),
                'PUT' => $http->put($url, $body ?? []),
                'DELETE' => $http->delete($url, $body ?? []),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $errorBody = $response->body();
                $errorData = $response->json();
                $errorMsg = is_array($errorData) && isset($errorData['errorSummary'])
                    ? $errorData['errorSummary']
                    : $errorBody;

                Log::error("Okta API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $errorMsg,
                ]);

                throw new \RuntimeException("Okta API error ({$response->status()}): " . (is_string($errorMsg) ? $errorMsg : json_encode($errorMsg)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Okta API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Okta API: {$e->getMessage()}");
        }
    }
}
