<?php

namespace OpenCompany\Integrations\Close;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Close CRM API service.
 *
 * Handles HTTP communication with the Close API using HTTP Basic authentication
 * (API key as username, empty password). Provides methods for leads, contacts,
 * activities, tasks, and user management.
 *
 * @see https://developer.close.com/
 */
class CloseService
{
    /**
     * Create a new CloseService instance.
     *
     * @param  string  $apiKey  Close API key used as the username in HTTP Basic auth.
     * @param  string  $baseUrl  Base URL for the Close API (defaults to https://api.close.com/api/v1).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.close.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ─── Leads ────────────────────────────────────────────────────────────

    /**
     * List leads with optional query and pagination.
     *
     * @param  string|null  $query  Search query string (Close search syntax).
     * @param  int  $limit  Maximum number of leads to return (default 25, max 100).
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @return array<string, mixed> API response containing leads and pagination info.
     *
     * @see https://developer.close.com/resources/leads/#list-leads
     */
    public function listLeads(?string $query = null, int $limit = 25, ?int $skip = null): array
    {
        $params = ['_limit' => min($limit, 100)];
        if ($query !== null) {
            $params['query'] = $query;
        }
        if ($skip !== null) {
            $params['_skip'] = $skip;
        }

        return $this->request('GET', '/lead/', $params);
    }

    /**
     * Get a single lead by ID.
     *
     * @param  string  $id  The lead ID (prefixed with "lead_").
     * @return array<string, mixed> The lead data.
     *
     * @see https://developer.close.com/resources/leads/#read-a-lead
     */
    public function getLead(string $id): array
    {
        return $this->request('GET', '/lead/' . urlencode($id) . '/');
    }

    /**
     * Create a new lead.
     *
     * @param  string  $name  The name of the lead / company.
     * @param  array<int, array<string, mixed>>  $contacts  Array of contact objects with name, email, phone, etc.
     * @param  array<string, mixed>  $extra  Additional lead fields (url, custom, status_id, etc.).
     * @return array<string, mixed> The created lead data.
     *
     * @see https://developer.close.com/resources/leads/#create-a-lead
     */
    public function createLead(string $name, array $contacts = [], array $extra = []): array
    {
        $data = array_merge(['name' => $name], $extra);
        if (! empty($contacts)) {
            $data['contacts'] = $contacts;
        }

        return $this->request('POST', '/lead/', $data);
    }

    /**
     * Update an existing lead.
     *
     * @param  string  $id  The lead ID (prefixed with "lead_").
     * @param  array<string, mixed>  $data  Fields to update (name, status_id, custom, etc.).
     * @return array<string, mixed> The updated lead data.
     *
     * @see https://developer.close.com/resources/leads/#update-a-lead
     */
    public function updateLead(string $id, array $data): array
    {
        return $this->request('PUT', '/lead/' . urlencode($id) . '/', $data);
    }

    /**
     * Delete a lead.
     *
     * @param  string  $id  The lead ID (prefixed with "lead_").
     *
     * @see https://developer.close.com/resources/leads/#delete-a-lead
     */
    public function deleteLead(string $id): void
    {
        $this->request('DELETE', '/lead/' . urlencode($id) . '/');
    }

    // ─── Contacts ─────────────────────────────────────────────────────────

    /**
     * List contacts with optional filtering and pagination.
     *
     * @param  string|null  $leadId  Filter contacts by lead ID.
     * @param  int  $limit  Maximum number of contacts to return (default 25, max 100).
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @return array<string, mixed> API response containing contacts and pagination info.
     *
     * @see https://developer.close.com/resources/contacts/#list-contacts
     */
    public function listContacts(?string $leadId = null, int $limit = 25, ?int $skip = null): array
    {
        $params = ['_limit' => min($limit, 100)];
        if ($leadId !== null) {
            $params['lead_id'] = $leadId;
        }
        if ($skip !== null) {
            $params['_skip'] = $skip;
        }

        return $this->request('GET', '/contact/', $params);
    }

    // ─── Activities ───────────────────────────────────────────────────────

    /**
     * List activities with optional filtering and pagination.
     *
     * @param  string|null  $leadId  Filter activities by lead ID.
     * @param  string|null  $type  Activity type filter (email, call, note, etc.).
     * @param  int  $limit  Maximum number of activities to return (default 25, max 100).
     * @param  int|null  $skip  Number of records to skip for pagination.
     * @return array<string, mixed> API response containing activities and pagination info.
     *
     * @see https://developer.close.com/resources/activities/#list-activities
     */
    public function listActivities(?string $leadId = null, ?string $type = null, int $limit = 25, ?int $skip = null): array
    {
        $params = ['_limit' => min($limit, 100)];
        if ($leadId !== null) {
            $params['lead_id'] = $leadId;
        }
        if ($type !== null) {
            $params['type'] = $type;
        }
        if ($skip !== null) {
            $params['_skip'] = $skip;
        }

        return $this->request('GET', '/activity/', $params);
    }

    // ─── Tasks ────────────────────────────────────────────────────────────

    /**
     * Create a new task.
     *
     * @param  string  $text  The task body / description.
     * @param  string|null  $leadId  Associate the task with a lead (optional).
     * @param  string|null  $assigneeId  User ID to assign the task to (optional).
     * @param  string|null  $dueDate  Due date in ISO 8601 format (optional).
     * @param  bool  $isComplete  Whether the task is already completed (default false).
     * @return array<string, mixed> The created task data.
     *
     * @see https://developer.close.com/resources/tasks/#create-a-task
     */
    public function createTask(
        string $text,
        ?string $leadId = null,
        ?string $assigneeId = null,
        ?string $dueDate = null,
        bool $isComplete = false,
    ): array {
        $data = [
            'text' => $text,
            'is_complete' => $isComplete,
        ];
        if ($leadId !== null) {
            $data['lead_id'] = $leadId;
        }
        if ($assigneeId !== null) {
            $data['assignee_id'] = $assigneeId;
        }
        if ($dueDate !== null) {
            $data['due_date'] = $dueDate;
        }

        return $this->request('POST', '/task/', $data);
    }

    // ─── User ─────────────────────────────────────────────────────────────

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The user profile data.
     *
     * @see https://developer.close.com/resources/users/#read-the-api-key-s-user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user/');
    }

    // ─── Internal helpers ─────────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g. "/lead/").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed> Parsed JSON response.
     *
     * @throws \RuntimeException On API errors or connection failures.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Close API using HTTP Basic auth.
     *
     * The API key is sent as the username with an empty password, per Close's
     * authentication requirements.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PUT/DELETE).
     * @return Response The raw HTTP response.
     *
     * @throws \RuntimeException On API errors, connection failures, or missing API key.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('Close API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, '')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Close API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Close API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $errors = $response->json('errors') ?? $response->json('error') ?? $body;
                Log::error("Close API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $errors,
                ]);
                throw new \RuntimeException("Close API error ({$response->status()}): " . (is_string($errors) ? $errors : json_encode($errors)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Close API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Close API: {$e->getMessage()}");
        }
    }
}
