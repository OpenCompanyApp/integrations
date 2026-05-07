<?php

namespace OpenCompany\Integrations\Salesloft;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Salesloft API.
 *
 * Handles Salesloft users, people, accounts, cadences, tasks, calls, emails,
 * notes, legacy sequence wrappers, and generic relative API requests.
 */
class SalesloftService
{
    /**
     * @param  string  $accessToken  Salesloft OAuth access token or API token.
     * @param  string  $baseUrl  Salesloft API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.salesloft.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List call sequences.
     *
     * @param  int  $limit   Maximum number of sequences to return per page.
     * @param  int  $page    Page number for pagination.
     * @param  string|null  $status  Filter by sequence status (e.g., "active", "paused").
     * @return array<string, mixed>
     */
    public function listSequences(int $limit = 25, int $page = 1, ?string $status = null): array
    {
        $params = [
            'per_page' => $limit,
            'page' => $page,
        ];

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/v3/call-sequences', $params);
    }

    /**
     * Get a single call sequence by ID.
     *
     * @param  int|string  $id  The sequence ID.
     * @return array<string, mixed>
     */
    public function getSequence(int|string $id): array
    {
        return $this->request('GET', '/v3/call-sequences/' . urlencode((string) $id));
    }

    /**
     * Create a new call sequence.
     *
     * @param  array<string, mixed> $data  Sequence data (name, steps, owner_id, status, targets).
     * @return array<string, mixed>
     */
    public function createSequence(array $data): array
    {
        return $this->request('POST', '/v3/call-sequences', $data);
    }

    /**
     * List automation rules.
     *
     * @param  int  $limit  Maximum number of rules to return per page.
     * @param  int  $page   Page number for pagination.
     * @return array<string, mixed>
     */
    public function listRules(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/v3/rules', [
            'per_page' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single automation rule by ID.
     *
     * @param  int|string  $id  The rule ID.
     * @return array<string, mixed>
     */
    public function getRule(int|string $id): array
    {
        return $this->request('GET', '/v3/rules/' . urlencode((string) $id));
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v3/users/me');
    }

    /**
     * List Salesloft users.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listUsers(array $params = []): array
    {
        return $this->request('GET', '/v2/users', $params);
    }

    /**
     * Get a Salesloft user.
     *
     * @param  int|string  $id  User ID.
     * @return array<string, mixed>
     */
    public function getUser(int|string $id): array
    {
        return $this->request('GET', '/v2/users/' . rawurlencode((string) $id));
    }

    /**
     * List people.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listPeople(array $params = []): array
    {
        return $this->request('GET', '/v2/people', $params);
    }

    /**
     * Get a person.
     *
     * @param  int|string  $id  Person ID.
     * @return array<string, mixed>
     */
    public function getPerson(int|string $id): array
    {
        return $this->request('GET', '/v2/people/' . rawurlencode((string) $id));
    }

    /**
     * Create a person.
     *
     * @param  array<string, mixed>  $payload  Person payload.
     * @return array<string, mixed>
     */
    public function createPerson(array $payload): array
    {
        return $this->request('POST', '/v2/people', $payload);
    }

    /**
     * Update a person.
     *
     * @param  int|string  $id  Person ID.
     * @param  array<string, mixed>  $payload  Person update payload.
     * @return array<string, mixed>
     */
    public function updatePerson(int|string $id, array $payload): array
    {
        return $this->request('PUT', '/v2/people/' . rawurlencode((string) $id), $payload);
    }

    /**
     * Delete a person.
     *
     * @param  int|string  $id  Person ID.
     * @return array<string, mixed>
     */
    public function deletePerson(int|string $id): array
    {
        return $this->request('DELETE', '/v2/people/' . rawurlencode((string) $id));
    }

    /**
     * List accounts.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAccounts(array $params = []): array
    {
        return $this->request('GET', '/v2/accounts', $params);
    }

    /**
     * Get an account.
     *
     * @param  int|string  $id  Account ID.
     * @return array<string, mixed>
     */
    public function getAccount(int|string $id): array
    {
        return $this->request('GET', '/v2/accounts/' . rawurlencode((string) $id));
    }

    /**
     * Create an account.
     *
     * @param  array<string, mixed>  $payload  Account payload.
     * @return array<string, mixed>
     */
    public function createAccount(array $payload): array
    {
        return $this->request('POST', '/v2/accounts', $payload);
    }

    /**
     * Update an account.
     *
     * @param  int|string  $id  Account ID.
     * @param  array<string, mixed>  $payload  Account update payload.
     * @return array<string, mixed>
     */
    public function updateAccount(int|string $id, array $payload): array
    {
        return $this->request('PUT', '/v2/accounts/' . rawurlencode((string) $id), $payload);
    }

    /**
     * Delete an account.
     *
     * @param  int|string  $id  Account ID.
     * @return array<string, mixed>
     */
    public function deleteAccount(int|string $id): array
    {
        return $this->request('DELETE', '/v2/accounts/' . rawurlencode((string) $id));
    }

    /**
     * List cadences.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCadences(array $params = []): array
    {
        return $this->request('GET', '/v2/cadences', $params);
    }

    /**
     * Get a cadence.
     *
     * @param  int|string  $id  Cadence ID.
     * @return array<string, mixed>
     */
    public function getCadence(int|string $id): array
    {
        return $this->request('GET', '/v2/cadences/' . rawurlencode((string) $id));
    }

    /**
     * List cadence memberships.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCadenceMemberships(array $params = []): array
    {
        return $this->request('GET', '/v2/cadence_memberships', $params);
    }

    /**
     * Create a cadence membership.
     *
     * @param  array<string, mixed>  $payload  Cadence membership payload.
     * @return array<string, mixed>
     */
    public function createCadenceMembership(array $payload): array
    {
        return $this->request('POST', '/v2/cadence_memberships', $payload);
    }

    /**
     * List tasks.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listTasks(array $params = []): array
    {
        return $this->request('GET', '/v2/tasks', $params);
    }

    /**
     * Get a task.
     *
     * @param  int|string  $id  Task ID.
     * @return array<string, mixed>
     */
    public function getTask(int|string $id): array
    {
        return $this->request('GET', '/v2/tasks/' . rawurlencode((string) $id));
    }

    /**
     * Update a task.
     *
     * @param  int|string  $id  Task ID.
     * @param  array<string, mixed>  $payload  Task update payload.
     * @return array<string, mixed>
     */
    public function updateTask(int|string $id, array $payload): array
    {
        return $this->request('PUT', '/v2/tasks/' . rawurlencode((string) $id), $payload);
    }

    /**
     * List calls.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCalls(array $params = []): array
    {
        return $this->request('GET', '/v2/activities/calls', $params);
    }

    /**
     * Create a call.
     *
     * @param  array<string, mixed>  $payload  Call payload.
     * @return array<string, mixed>
     */
    public function createCall(array $payload): array
    {
        return $this->request('POST', '/v2/activities/calls', $payload);
    }

    /**
     * List emails.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listEmails(array $params = []): array
    {
        return $this->request('GET', '/v2/activities/emails', $params);
    }

    /**
     * List notes.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listNotes(array $params = []): array
    {
        return $this->request('GET', '/v2/notes', $params);
    }

    /**
     * Create a note.
     *
     * @param  array<string, mixed>  $payload  Note payload.
     * @return array<string, mixed>
     */
    public function createNote(array $payload): array
    {
        return $this->request('POST', '/v2/notes', $payload);
    }

    /**
     * Send a GET request to a relative Salesloft API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Send a POST request to a relative Salesloft API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Send a PUT request to a relative Salesloft API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Send a DELETE request to a relative Salesloft API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  Optional JSON body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Salesloft API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new RuntimeException('Salesloft access token is not configured.');
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
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Salesloft API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("Salesloft API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Salesloft API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("Salesloft API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Salesloft API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to Salesloft API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize and validate caller-supplied relative API paths.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '' || str_contains($path, '://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Salesloft API path must be relative, such as /v2/people.');
        }

        return str_starts_with($path, '/') ? $path : '/' . $path;
    }
}
