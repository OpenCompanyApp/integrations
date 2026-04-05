<?php

namespace OpenCompany\Integrations\BambooHR;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * BambooHR API client for employee, department, and time-off management.
 *
 * Handles HTTP Basic authentication and all API communication with the
 * BambooHR v1 REST API. Tools call service methods — they never make
 * HTTP requests directly.
 */
class BambooHRService
{
    private string $baseUrl;

    public function __construct(
        private string $apiKey = '',
        private string $subdomain = '',
    ) {
        $this->baseUrl = $this->subdomain
            ? "https://api.bamboohr.com/api/gateway.php/{$this->subdomain}/v1"
            : '';
    }

    /**
     * Check whether the service has sufficient credentials to make API calls.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) && ! empty($this->subdomain);
    }

    // ── Employees ─────────────────────────────────────────

    /**
     * List employees with optional pagination.
     *
     * @param  array<string>  $fields  Employee fields to include (e.g., ["firstName", "lastName", "jobTitle"]).
     * @param  int  $page  Page number for pagination (1-based).
     * @param  int  $limit  Number of results per page.
     * @return array<string, mixed>
     */
    public function listEmployees(array $fields = [], int $page = 1, int $limit = 50): array
    {
        $params = [];

        if (! empty($fields)) {
            $params['fields'] = implode(',', $fields);
        }

        if ($page > 1) {
            $params['page'] = $page;
        }

        if ($limit !== 50) {
            $params['limit'] = $limit;
        }

        return $this->request('GET', '/employees/directory');
    }

    /**
     * Get a single employee by ID.
     *
     * @param  string|int  $employeeId  The BambooHR employee ID.
     * @param  array<string>  $fields  Fields to include (empty = default fields).
     * @return array<string, mixed>
     */
    public function getEmployee(string|int $employeeId, array $fields = []): array
    {
        $path = '/employees/' . urlencode((string) $employeeId);

        if (! empty($fields)) {
            $path .= '?fields=' . urlencode(implode(',', $fields));
        }

        return $this->request('GET', $path);
    }

    /**
     * Create a new employee.
     *
     * @param  array<string, mixed>  $data  Employee data (firstName, lastName, email, etc.).
     * @return array<string, mixed>
     */
    public function createEmployee(array $data): array
    {
        return $this->request('POST', '/employees', $data);
    }

    /**
     * Update an existing employee.
     *
     * @param  string|int  $employeeId  The BambooHR employee ID.
     * @param  array<string, mixed>  $data  Fields to update.
     * @return array<string, mixed>
     */
    public function updateEmployee(string|int $employeeId, array $data): array
    {
        return $this->request('POST', '/employees/' . urlencode((string) $employeeId), $data);
    }

    // ── Departments ───────────────────────────────────────

    /**
     * List all departments in the company.
     *
     * @return array<string, mixed>
     */
    public function listDepartments(): array
    {
        return $this->request('GET', '/departments');
    }

    // ── Time Off ──────────────────────────────────────────

    /**
     * List time-off requests with optional filters.
     *
     * @param  array<string, mixed>  $params  Filter parameters (status, start, end, employeeId, etc.).
     * @return array<string, mixed>
     */
    public function listTimeOffRequests(array $params = []): array
    {
        return $this->request('GET', '/time_off/requests', $params);
    }

    // ── Users ─────────────────────────────────────────────

    /**
     * Get the current authenticated user's information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    // ── HTTP ──────────────────────────────────────────────

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query params (GET) or body data (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        $body = trim($response->body());

        if (empty($body)) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the BambooHR API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On configuration, connection, or API errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('BambooHR integration is not configured. Provide both api_key and subdomain.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apiKey, 'x')->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("BambooHR API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException(
                    'BambooHR API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("BambooHR API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to BambooHR API: {$e->getMessage()}");
        }
    }
}
