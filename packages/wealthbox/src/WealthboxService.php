<?php

namespace OpenCompany\Integrations\Wealthbox;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WealthboxService
{
    /**
     * Create a new WealthboxService instance.
     *
     * @param  string  $accessToken  The OAuth access token for the Wealthbox API.
     * @param  string  $baseUrl  The base URL for the Wealthbox API.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.crmworkspace.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Wealthbox integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List contacts from Wealthbox CRM.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., page, per_page, search).
     * @return array<string, mixed>
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/contacts', $params);
    }

    /**
     * Get a specific contact by ID.
     *
     * @param  int  $id  The contact ID.
     * @return array<string, mixed>
     */
    public function getContact(int $id): array
    {
        return $this->request('GET', '/contacts/' . $id);
    }

    /**
     * Create a new contact in Wealthbox CRM.
     *
     * @param  array<string, mixed>  $data  Contact data (e.g., first_name, last_name, email, phone).
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->request('POST', '/contacts', $data);
    }

    /**
     * List tasks from Wealthbox CRM.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., page, per_page, status).
     * @return array<string, mixed>
     */
    public function listTasks(array $params = []): array
    {
        return $this->request('GET', '/tasks', $params);
    }

    /**
     * Create a new task in Wealthbox CRM.
     *
     * @param  array<string, mixed>  $data  Task data (e.g., name, due_date, assignee_id).
     * @return array<string, mixed>
     */
    public function createTask(array $data): array
    {
        return $this->request('POST', '/tasks', $data);
    }

    /**
     * List opportunities from Wealthbox CRM.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., page, per_page, status).
     * @return array<string, mixed>
     */
    public function listOpportunities(array $params = []): array
    {
        return $this->request('GET', '/opportunities', $params);
    }

    /**
     * List workflows from Wealthbox CRM.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., page, per_page).
     * @return array<string, mixed>
     */
    public function listWorkflows(array $params = []): array
    {
        return $this->request('GET', '/workflows', $params);
    }

    /**
     * List calendar events from Wealthbox CRM.
     *
     * @param  array<string, mixed>  $params  Query parameters (e.g., page, per_page, start_date, end_date).
     * @return array<string, mixed>
     */
    public function listEvents(array $params = []): array
    {
        return $this->request('GET', '/events', $params);
    }

    /**
     * Get the currently authenticated Wealthbox user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., /contacts).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Wealthbox API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g., /contacts).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing, the request fails, or a connection error occurs.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Wealthbox access token is not configured.');
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
                    Log::warning("Wealthbox API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Wealthbox API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Wealthbox API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Wealthbox API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Wealthbox API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Wealthbox API: {$e->getMessage()}");
        }
    }
}
