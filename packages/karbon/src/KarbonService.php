<?php

namespace OpenCompany\Integrations\Karbon;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KarbonService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.karbonhq.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List contacts with pagination.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @return array<string, mixed>
     */
    public function listContacts(int $page = 1, int $limit = 20): array
    {
        return $this->request('GET', '/v1/contacts', [
            'page' => $page,
            'limit' => $limit,
        ]);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $id  The contact identifier.
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/v1/contacts/' . urlencode($id));
    }

    /**
     * Create a new contact.
     *
     * @param  array<string, mixed>  $data  Contact data (firstName, lastName, email, company, phone).
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/v1/contacts', $data);
    }

    /**
     * List work items with optional filters.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $status  Filter by work item status.
     * @param  string|null  $assignee  Filter by assigned user.
     * @return array<string, mixed>
     */
    public function listWorkItems(int $page = 1, int $limit = 20, ?string $status = null, ?string $assignee = null): array
    {
        $params = [
            'page' => $page,
            'limit' => $limit,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        if ($assignee !== null) {
            $params['assignee'] = $assignee;
        }

        return $this->request('GET', '/v1/work-items', $params);
    }

    /**
     * Get a single work item by ID.
     *
     * @param  string  $id  The work item identifier.
     * @return array<string, mixed>
     */
    public function getWorkItem(string $id): array
    {
        return $this->request('GET', '/v1/work-items/' . urlencode($id));
    }

    /**
     * List users with pagination.
     *
     * @param  int  $limit  Number of results to return.
     * @return array<string, mixed>
     */
    public function listUsers(int $limit = 20): array
    {
        return $this->request('GET', '/v1/users', [
            'limit' => $limit,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v1/users/me');
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
     * Make a raw HTTP request to the Karbon API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Karbon access token is not configured.');
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
                    Log::warning("Karbon API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Karbon API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service may be down.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Karbon API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Karbon API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Karbon API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Karbon API: {$e->getMessage()}");
        }
    }
}
