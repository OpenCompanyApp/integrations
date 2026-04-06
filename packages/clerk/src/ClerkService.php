<?php

namespace OpenCompany\Integrations\Clerk;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClerkService
{
    /**
     * Create a new ClerkService instance.
     *
     * @param  string  $secretKey  The Clerk Backend API secret key.
     * @param  string  $baseUrl    The Clerk API base URL.
     */
    public function __construct(
        private string $secretKey = '',
        private string $baseUrl = 'https://api.clerk.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Clerk service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->secretKey);
    }

    /**
     * List users with optional filtering and pagination.
     *
     * @param  array  $params  Query parameters (limit, offset, email_address, phone_number, query, order_by).
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/users', $params);
    }

    /**
     * Get a single user by ID.
     *
     * @param  string  $userId  The Clerk user ID.
     * @return array<string, mixed>
     */
    public function getUser(string $userId): array
    {
        return $this->request('GET', '/users/' . urlencode($userId));
    }

    /**
     * Create a new user.
     *
     * @param  array  $data  User data (email_address, first_name, last_name, password, username).
     * @return array<string, mixed>
     */
    public function createUser(array $data): array
    {
        return $this->request('POST', '/users', $data);
    }

    /**
     * Update an existing user.
     *
     * @param  string  $userId  The Clerk user ID.
     * @param  array  $data     Fields to update (first_name, last_name, username).
     * @return array<string, mixed>
     */
    public function updateUser(string $userId, array $data): array
    {
        return $this->request('PATCH', '/users/' . urlencode($userId), $data);
    }

    /**
     * Delete a user by ID.
     *
     * @param  string  $userId  The Clerk user ID.
     * @return array<string, mixed>
     */
    public function deleteUser(string $userId): array
    {
        return $this->request('DELETE', '/users/' . urlencode($userId));
    }

    /**
     * List organizations with optional filtering and pagination.
     *
     * @param  array  $params  Query parameters (limit, offset, query).
     * @return array<string, mixed>
     */
    public function listOrganizations(array $params = []): array
    {
        return $this->request('GET', '/organizations', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array  $data     Query parameters or request body.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        $body = $response->body();
        if (empty($body)) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Clerk Backend API.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array  $data     Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->secretKey) {
            throw new \RuntimeException('Clerk secret key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('errors.0.message') ?? $response->body();
                Log::error("Clerk API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Clerk API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Clerk API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Clerk API: {$e->getMessage()}");
        }
    }
}
