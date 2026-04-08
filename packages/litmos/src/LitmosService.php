<?php

namespace OpenCompany\Integrations\Litmos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Litmos API service for interacting with the Litmos LMS platform.
 *
 * Handles authentication, request formatting, and error handling for all
 * Litmos API v1 endpoints including users, courses, and teams.
 */
class LitmosService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.litmos.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List users with optional pagination and search.
     *
     * @param  int  $limit   Number of results per page (max 1000).
     * @param  int  $page    Page number (1-based).
     * @param  string|null  $search  Search term to filter users by name or email.
     * @return array<string, mixed>
     */
    public function listUsers(int $limit = 100, int $page = 1, ?string $search = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($search !== null && $search !== '') {
            $params['search'] = $search;
        }

        return $this->request('GET', '/1/users', $params);
    }

    /**
     * Get a single user by their Litmos user ID.
     *
     * @param  string  $id  The Litmos user ID.
     * @return array<string, mixed>
     */
    public function getUser(string $id): array
    {
        return $this->request('GET', '/1/users/' . urlencode($id));
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/1/users/me');
    }

    /**
     * Create a new user in Litmos.
     *
     * @param  string  $firstName  The user's first name.
     * @param  string  $lastName   The user's last name.
     * @param  string  $email      The user's email address.
     * @param  string  $userName   The user's login username.
     * @return array<string, mixed>
     */
    public function createUser(string $firstName, string $lastName, string $email, string $userName): array
    {
        return $this->request('POST', '/1/users', [], [
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'Email' => $email,
            'UserName' => $userName,
        ]);
    }

    /**
     * List courses with optional pagination and search.
     *
     * @param  int  $limit   Number of results per page (max 1000).
     * @param  int  $page    Page number (1-based).
     * @param  string|null  $search  Search term to filter courses by name.
     * @return array<string, mixed>
     */
    public function listCourses(int $limit = 100, int $page = 1, ?string $search = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($search !== null && $search !== '') {
            $params['search'] = $search;
        }

        return $this->request('GET', '/1/courses', $params);
    }

    /**
     * Get a single course by its Litmos course ID.
     *
     * @param  string  $id  The Litmos course ID.
     * @return array<string, mixed>
     */
    public function getCourse(string $id): array
    {
        return $this->request('GET', '/1/courses/' . urlencode($id));
    }

    /**
     * List teams with optional pagination.
     *
     * @param  int  $limit  Number of results per page (max 1000).
     * @param  int  $page   Page number (1-based).
     * @return array<string, mixed>
     */
    public function listTeams(int $limit = 100, int $page = 1): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        return $this->request('GET', '/1/teams', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g., "/1/users").
     * @param  array  $query   Query parameters for GET requests.
     * @param  array  $body    Request body for POST/PUT requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Litmos API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array  $query   Query parameters.
     * @param  array  $body    Request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Litmos API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type') ?? '';
                $responseBody = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($responseBody), '<!DOCTYPE')) {
                    Log::warning("Litmos API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Litmos API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not exist or the URL may be incorrect.");
                }

                $error = $response->json('Message') ?? $response->json('error') ?? $responseBody;
                Log::error("Litmos API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Litmos API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Litmos API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Litmos API: {$e->getMessage()}");
        }
    }
}
