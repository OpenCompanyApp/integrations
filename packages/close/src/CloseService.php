<?php

namespace OpenCompany\Integrations\Close;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

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

    // Leads

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

        return $this->apiGet('/lead/', $params);
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
        return $this->apiGet('/lead/' . rawurlencode($id) . '/');
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

        return $this->apiPost('/lead/', $data);
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
        return $this->apiPut('/lead/' . rawurlencode($id) . '/', $data);
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
        $this->apiDelete('/lead/' . rawurlencode($id) . '/');
    }

    // Contacts

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

        return $this->apiGet('/contact/', $params);
    }

    /**
     * Get a single contact by ID.
     *
     * @param  string  $id  Close contact ID.
     * @return array<string, mixed>
     */
    public function getContact(string $id): array
    {
        return $this->apiGet('/contact/' . rawurlencode($id) . '/');
    }

    /**
     * Create a contact.
     *
     * @param  array<string, mixed>  $data  Contact fields including lead_id, name, emails, phones, title, and custom.
     * @return array<string, mixed>
     */
    public function createContact(array $data): array
    {
        return $this->apiPost('/contact/', $data);
    }

    /**
     * Update a contact.
     *
     * @param  string  $id  Close contact ID.
     * @param  array<string, mixed>  $data  Fields to patch.
     * @return array<string, mixed>
     */
    public function updateContact(string $id, array $data): array
    {
        return $this->apiPut('/contact/' . rawurlencode($id) . '/', $data);
    }

    /**
     * Delete a contact.
     *
     * @param  string  $id  Close contact ID.
     * @return array<string, mixed>
     */
    public function deleteContact(string $id): array
    {
        return $this->apiDelete('/contact/' . rawurlencode($id) . '/');
    }

    // Activities

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

        return $this->apiGet('/activity/', $params);
    }

    /**
     * List Note activities.
     *
     * @param  array<string, mixed>  $params  Query parameters such as lead_id, user_id, date filters, _limit, and _skip.
     * @return array<string, mixed>
     */
    public function listNotes(array $params = []): array
    {
        return $this->apiGet('/activity/note/', $params);
    }

    /**
     * Get a Note activity by ID.
     *
     * @param  string  $id  Close note activity ID.
     * @return array<string, mixed>
     */
    public function getNote(string $id): array
    {
        return $this->apiGet('/activity/note/' . rawurlencode($id) . '/');
    }

    /**
     * Create a Note activity.
     *
     * @param  array<string, mixed>  $data  Note fields including lead_id and note.
     * @return array<string, mixed>
     */
    public function createNote(array $data): array
    {
        return $this->apiPost('/activity/note/', $data);
    }

    /**
     * Update a Note activity.
     *
     * @param  string  $id  Close note activity ID.
     * @param  array<string, mixed>  $data  Fields to patch.
     * @return array<string, mixed>
     */
    public function updateNote(string $id, array $data): array
    {
        return $this->apiPut('/activity/note/' . rawurlencode($id) . '/', $data);
    }

    /**
     * Delete a Note activity.
     *
     * @param  string  $id  Close note activity ID.
     * @return array<string, mixed>
     */
    public function deleteNote(string $id): array
    {
        return $this->apiDelete('/activity/note/' . rawurlencode($id) . '/');
    }

    // Tasks

    /**
     * List tasks with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters such as lead_id, assigned_to, is_complete, _type, _limit, and _skip.
     * @return array<string, mixed>
     */
    public function listTasks(array $params = []): array
    {
        return $this->apiGet('/task/', $params);
    }

    /**
     * Create a new task.
     *
     * @param  string  $text  The task body / description.
     * @param  string|null  $leadId  Associate the task with a lead (optional).
     * @param  string|null  $assigneeId  User ID to assign the task to (optional).
     * @param  string|null  $date  Task date in YYYY-MM-DD format (optional).
     * @param  bool  $isComplete  Whether the task is already completed (default false).
     * @return array<string, mixed> The created task data.
     *
     * @see https://developer.close.com/resources/tasks/#create-a-task
     */
    public function createTask(
        string $text,
        ?string $leadId = null,
        ?string $assigneeId = null,
        ?string $date = null,
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
            $data['assigned_to'] = $assigneeId;
        }
        if ($date !== null) {
            $data['date'] = $date;
        }

        return $this->apiPost('/task/', $data);
    }

    /**
     * Get a task by ID.
     *
     * @param  string  $id  Close task ID.
     * @return array<string, mixed>
     */
    public function getTask(string $id): array
    {
        return $this->apiGet('/task/' . rawurlencode($id) . '/');
    }

    /**
     * Update a task.
     *
     * @param  string  $id  Close task ID.
     * @param  array<string, mixed>  $data  Fields to patch.
     * @return array<string, mixed>
     */
    public function updateTask(string $id, array $data): array
    {
        return $this->apiPut('/task/' . rawurlencode($id) . '/', $data);
    }

    /**
     * Delete a task.
     *
     * @param  string  $id  Close task ID.
     * @return array<string, mixed>
     */
    public function deleteTask(string $id): array
    {
        return $this->apiDelete('/task/' . rawurlencode($id) . '/');
    }

    // Opportunities

    /**
     * List opportunities with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters such as lead_id, status_id, user_id, _limit, and _skip.
     * @return array<string, mixed>
     */
    public function listOpportunities(array $params = []): array
    {
        return $this->apiGet('/opportunity/', $params);
    }

    /**
     * Get an opportunity by ID.
     *
     * @param  string  $id  Close opportunity ID.
     * @return array<string, mixed>
     */
    public function getOpportunity(string $id): array
    {
        return $this->apiGet('/opportunity/' . rawurlencode($id) . '/');
    }

    /**
     * Create an opportunity.
     *
     * @param  array<string, mixed>  $data  Opportunity fields including lead_id, status_id, value, value_period, and confidence.
     * @return array<string, mixed>
     */
    public function createOpportunity(array $data): array
    {
        return $this->apiPost('/opportunity/', $data);
    }

    /**
     * Update an opportunity.
     *
     * @param  string  $id  Close opportunity ID.
     * @param  array<string, mixed>  $data  Fields to patch.
     * @return array<string, mixed>
     */
    public function updateOpportunity(string $id, array $data): array
    {
        return $this->apiPut('/opportunity/' . rawurlencode($id) . '/', $data);
    }

    /**
     * Delete an opportunity.
     *
     * @param  string  $id  Close opportunity ID.
     * @return array<string, mixed>
     */
    public function deleteOpportunity(string $id): array
    {
        return $this->apiDelete('/opportunity/' . rawurlencode($id) . '/');
    }

    // Users

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed> The user profile data.
     *
     * @see https://developer.close.com/resources/users/#read-the-api-key-s-user
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/me/');
    }

    /**
     * List users in the organization.
     *
     * @param  array<string, mixed>  $params  Query parameters such as _limit, _skip, and query.
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->apiGet('/user/', $params);
    }

    /**
     * Get a user by ID.
     *
     * @param  string  $id  Close user ID.
     * @return array<string, mixed>
     */
    public function getUser(string $id): array
    {
        return $this->apiGet('/user/' . rawurlencode($id) . '/');
    }

    /**
     * List user availability statuses.
     *
     * @return array<string, mixed>
     */
    public function listUserAvailability(): array
    {
        return $this->apiGet('/user/availability/');
    }

    // Statuses and pipelines

    /**
     * List lead statuses.
     *
     * @return array<string, mixed>
     */
    public function listLeadStatuses(): array
    {
        return $this->apiGet('/status/lead/');
    }

    /**
     * Create a lead status.
     *
     * @param  array<string, mixed>  $data  Status fields.
     * @return array<string, mixed>
     */
    public function createLeadStatus(array $data): array
    {
        return $this->apiPost('/status/lead/', $data);
    }

    /**
     * Update a lead status.
     *
     * @param  string  $id  Close lead status ID.
     * @param  array<string, mixed>  $data  Fields to patch.
     * @return array<string, mixed>
     */
    public function updateLeadStatus(string $id, array $data): array
    {
        return $this->apiPut('/status/lead/' . rawurlencode($id) . '/', $data);
    }

    /**
     * Delete a lead status.
     *
     * @param  string  $id  Close lead status ID.
     * @return array<string, mixed>
     */
    public function deleteLeadStatus(string $id): array
    {
        return $this->apiDelete('/status/lead/' . rawurlencode($id) . '/');
    }

    /**
     * List opportunity statuses.
     *
     * @return array<string, mixed>
     */
    public function listOpportunityStatuses(): array
    {
        return $this->apiGet('/status/opportunity/');
    }

    /**
     * Create an opportunity status.
     *
     * @param  array<string, mixed>  $data  Status fields.
     * @return array<string, mixed>
     */
    public function createOpportunityStatus(array $data): array
    {
        return $this->apiPost('/status/opportunity/', $data);
    }

    /**
     * Update an opportunity status.
     *
     * @param  string  $id  Close opportunity status ID.
     * @param  array<string, mixed>  $data  Fields to patch.
     * @return array<string, mixed>
     */
    public function updateOpportunityStatus(string $id, array $data): array
    {
        return $this->apiPut('/status/opportunity/' . rawurlencode($id) . '/', $data);
    }

    /**
     * Delete an opportunity status.
     *
     * @param  string  $id  Close opportunity status ID.
     * @return array<string, mixed>
     */
    public function deleteOpportunityStatus(string $id): array
    {
        return $this->apiDelete('/status/opportunity/' . rawurlencode($id) . '/');
    }

    /**
     * List pipelines.
     *
     * @return array<string, mixed>
     */
    public function listPipelines(): array
    {
        return $this->apiGet('/pipeline/');
    }

    /**
     * Create a pipeline.
     *
     * @param  array<string, mixed>  $data  Pipeline fields.
     * @return array<string, mixed>
     */
    public function createPipeline(array $data): array
    {
        return $this->apiPost('/pipeline/', $data);
    }

    /**
     * Update a pipeline.
     *
     * @param  string  $id  Close pipeline ID.
     * @param  array<string, mixed>  $data  Fields to patch.
     * @return array<string, mixed>
     */
    public function updatePipeline(string $id, array $data): array
    {
        return $this->apiPut('/pipeline/' . rawurlencode($id) . '/', $data);
    }

    /**
     * Delete a pipeline.
     *
     * @param  string  $id  Close pipeline ID.
     * @return array<string, mixed>
     */
    public function deletePipeline(string $id): array
    {
        return $this->apiDelete('/pipeline/' . rawurlencode($id) . '/');
    }

    // Generic request helpers

    /**
     * Run a GET request against a Close API path.
     *
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Run a POST request against a Close API path.
     *
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $query, $body);
    }

    /**
     * Run a PUT request against a Close API path.
     *
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, $query, $body);
    }

    /**
     * Run a DELETE request against a Close API path.
     *
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    // Internal helpers

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path (e.g. "/lead/").
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed> Parsed JSON response.
     *
     * @throws RuntimeException On API errors or connection failures.
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
     * Make a raw HTTP request to the Close API using HTTP Basic auth.
     *
     * The API key is sent as the username with an empty password, per Close's
     * authentication requirements.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return Response The raw HTTP response.
     *
     * @throws RuntimeException On API errors, connection failures, or missing API key.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (! $this->apiKey) {
            throw new RuntimeException('Close API key is not configured.');
        }

        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withBasicAuth($this->apiKey, '')
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url),
                'POST'   => $http->post($url, $body),
                'PUT'    => $http->put($url, $body),
                'DELETE' => $http->delete($url),
                default  => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Close API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Close API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $errors = $response->json('errors') ?? $response->json('error') ?? $body;
                Log::error("Close API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $errors,
                ]);
                throw new RuntimeException("Close API error ({$response->status()}): " . (is_string($errors) ? $errors : json_encode($errors)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Close API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Close API: {$e->getMessage()}");
        }
    }

    /**
     * Build a request URL with deterministic query string encoding.
     *
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query = []): string
    {
        $url = $this->baseUrl . '/' . ltrim($path, '/');
        $query = array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');

        if ($query === []) {
            return $url;
        }

        return $url . '?' . http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    }
}
