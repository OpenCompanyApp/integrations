<?php

namespace OpenCompany\Integrations\ServiceNow;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the ServiceNow REST API (Table API and User Profile).
 *
 * Authenticates via HTTP Basic Auth using a ServiceNow username and password.
 * The base URL is constructed from the configured instance name:
 *   https://{instance}.service-now.com/api/now
 *
 * @see https://developer.servicenow.com/dev.do#!/reference/api/now/rest
 */
class ServiceNowService
{
    /**
     * Create a new ServiceNow service instance.
     *
     * @param  string  $username  ServiceNow username (e.g. admin).
     * @param  string  $password  ServiceNow password.
     * @param  string  $instance  ServiceNow instance name (e.g. "dev12345").
     */
    public function __construct(
        private string $username = '',
        private string $password = '',
        private string $instance = '',
    ) {}

    /**
     * Determine whether the service has the minimum required credentials.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->username)
            && ! empty($this->password)
            && ! empty($this->instance);
    }

    /**
     * Build the base API URL from the instance name.
     *
     * @return string The base URL, e.g. https://dev12345.service-now.com/api/now
     */
    public function getBaseUrl(): string
    {
        return rtrim("https://{$this->instance}.service-now.com/api/now", '/');
    }

    // ─── Incident endpoints ───────────────────────────────────────────────

    /**
     * List incidents from the incident table.
     *
     * @param  string|null  $query  A ServiceNow encoded query string (sysparm_query).
     * @param  int  $limit  Maximum number of records to return (sysparm_limit).
     * @return array The API response containing incident records.
     *
     * @see https://developer.servicenow.com/dev.do#!/reference/api/now/rest/c_Table_API#r_Table_API-GET
     */
    public function listIncidents(?string $query = null, int $limit = 20): array
    {
        $params = ['sysparm_limit' => $limit];
        if ($query !== null && $query !== '') {
            $params['sysparm_query'] = $query;
        }

        return $this->request('GET', '/table/incident', $params);
    }

    /**
     * Get a single incident by its sys_id.
     *
     * @param  string  $id  The sys_id of the incident.
     * @return array The incident record.
     */
    public function getIncident(string $id): array
    {
        return $this->request('GET', '/table/incident/' . urlencode($id));
    }

    /**
     * Create a new incident.
     *
     * @param  array  $data  Incident fields (e.g. short_description, description, priority, caller_id).
     * @return array The created incident record.
     */
    public function createIncident(array $data): array
    {
        return $this->request('POST', '/table/incident', [], $data);
    }

    /**
     * Update an existing incident.
     *
     * @param  string  $id  The sys_id of the incident to update.
     * @param  array  $data  Fields to update (e.g. state, work_notes, comments).
     * @return array The updated incident record.
     */
    public function updateIncident(string $id, array $data): array
    {
        return $this->request('PATCH', '/table/incident/' . urlencode($id), [], $data);
    }

    // ─── Task endpoints ───────────────────────────────────────────────────

    /**
     * List tasks from the task table.
     *
     * @param  string|null  $query  A ServiceNow encoded query string (sysparm_query).
     * @param  int  $limit  Maximum number of records to return.
     * @return array The API response containing task records.
     */
    public function listTasks(?string $query = null, int $limit = 20): array
    {
        $params = ['sysparm_limit' => $limit];
        if ($query !== null && $query !== '') {
            $params['sysparm_query'] = $query;
        }

        return $this->request('GET', '/table/task', $params);
    }

    /**
     * Get a single task by its sys_id.
     *
     * @param  string  $id  The sys_id of the task.
     * @return array The task record.
     */
    public function getTask(string $id): array
    {
        return $this->request('GET', '/table/task/' . urlencode($id));
    }

    /**
     * Create a new task.
     *
     * @param  array  $data  Task fields (e.g. short_description, description, assigned_to).
     * @return array The created task record.
     */
    public function createTask(array $data): array
    {
        return $this->request('POST', '/table/task', [], $data);
    }

    // ─── User endpoints ───────────────────────────────────────────────────

    /**
     * List users from the sys_user table.
     *
     * @param  string|null  $query  A ServiceNow encoded query string (sysparm_query).
     * @param  int  $limit  Maximum number of records to return.
     * @return array The API response containing user records.
     */
    public function listUsers(?string $query = null, int $limit = 20): array
    {
        $params = ['sysparm_limit' => $limit];
        if ($query !== null && $query !== '') {
            $params['sysparm_query'] = $query;
        }

        return $this->request('GET', '/table/sys_user', $params);
    }

    /**
     * Get a single user by their sys_id.
     *
     * @param  string  $id  The sys_id of the user.
     * @return array The user record.
     */
    public function getUser(string $id): array
    {
        return $this->request('GET', '/table/sys_user/' . urlencode($id));
    }

    /**
     * Get the profile of the currently authenticated user.
     *
     * Uses the /api/now/ui/user/{currentUser} endpoint which returns
     * the profile for the user whose credentials are used for Basic Auth.
     *
     * @return array The current user's profile data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user_profile');
    }

    // ─── HTTP layer ───────────────────────────────────────────────────────

    /**
     * Make an authenticated API request and return the parsed JSON response.
     *
     * @param  string  $method  HTTP method (GET, POST, PATCH, PUT, DELETE).
     * @param  string  $path    Relative API path (e.g. "/table/incident").
     * @param  array  $query   Query parameters to append to the URL.
     * @param  array  $body    JSON body for POST/PATCH/PUT requests.
     * @return array The parsed JSON response body.
     *
     * @throws \RuntimeException When the API returns an error or is unreachable.
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        return $response->json() ?? [];
    }

    /**
     * Send a raw HTTP request to the ServiceNow REST API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    Relative API path.
     * @param  array  $query   Query parameters.
     * @param  array  $body    JSON body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException When credentials are missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): \Illuminate\Http\Client\Response
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('ServiceNow integration is not configured. Provide username, password, and instance.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->withBasicAuth($this->username, $this->password)
              ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'   => $http->get($url, $query),
                'POST'  => $http->post($url, $body),
                'PUT'   => $http->put($url, $body),
                'PATCH' => $http->patch($url, $body),
                'DELETE'=> $http->delete($url, $body),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('error.message')
                    ?? $response->json('error')
                    ?? $response->body();

                Log::error("ServiceNow API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error'  => $error,
                ]);

                throw new \RuntimeException(
                    "ServiceNow API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ServiceNow API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to ServiceNow API: {$e->getMessage()}");
        }
    }
}
