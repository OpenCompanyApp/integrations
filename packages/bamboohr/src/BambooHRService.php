<?php

namespace OpenCompany\Integrations\BambooHR;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BambooHRService
{
    public function __construct(
        private string $apiKey = '',
        private string $subdomain = '',
    ) {}

    /**
     * Check whether the service has been configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->subdomain);
    }

    /**
     * Get the base URL for the BambooHR API.
     */
    private function baseUrl(): string
    {
        return 'https://api.bamboohr.com/api/gateway.php/' . $this->subdomain . '/v1';
    }

    /**
     * List employees with optional pagination and field selection.
     *
     * @param  array<string>  $fields  Employee fields to include (e.g., ["firstName", "lastName", "jobTitle"]).
     * @return array<string, mixed>
     */
    public function listEmployees(array $fields = ['id', 'firstName', 'lastName', 'jobTitle', 'department'], int $page = 1, int $perPage = 50): array
    {
        return $this->request('GET', '/employees/directory');
    }

    /**
     * Get a single employee by ID.
     *
     * @param  int|string  $employeeId
     * @param  array<string>  $fields
     * @return array<string, mixed>
     */
    public function getEmployee(int|string $employeeId, array $fields = []): array
    {
        $query = [];
        if (!empty($fields)) {
            $query['fields'] = implode(',', $fields);
        }

        return $this->request('GET', '/employees/' . urlencode((string) $employeeId), $query);
    }

    /**
     * Create a new employee.
     *
     * @param  array<string, mixed>  $data  Employee data (e.g., firstName, lastName, workEmail, jobTitle).
     * @return array<string, mixed>
     */
    public function createEmployee(array $data): array
    {
        return $this->request('POST', '/employees', $data);
    }

    /**
     * Update an existing employee.
     *
     * @param  int|string  $employeeId
     * @param  array<string, mixed>  $data  Fields to update.
     * @return array<string, mixed>
     */
    public function updateEmployee(int|string $employeeId, array $data): array
    {
        return $this->request('POST', '/employees/' . urlencode((string) $employeeId), $data);
    }

    /**
     * List all departments.
     *
     * @return array<string, mixed>
     */
    public function listDepartments(): array
    {
        return $this->request('GET', '/departments');
    }

    /**
     * List time-off requests with optional filters.
     *
     * @param  array<string, mixed>  $filters  Optional query parameters (e.g., start, end, status, employeeId).
     * @return array<string, mixed>
     */
    public function listTimeOffRequests(array $filters = []): array
    {
        return $this->request('GET', '/time_off/requests', $filters);
    }

    /**
     * Get the current authenticated user.
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
     * @param  string  $path  API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        $body = $response->body();
        $json = $response->json();

        if ($json !== null) {
            return $json;
        }

        // Some endpoints return empty bodies on success
        if ($response->successful() && empty(trim($body))) {
            return ['success' => true];
        }

        return ['raw' => $body];
    }

    /**
     * Make a raw HTTP request to the BambooHR API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey || !$this->subdomain) {
            throw new \RuntimeException('BambooHR API key and subdomain are not configured.');
        }

        $url = $this->baseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->apiKey, '')->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->body();
                Log::error("BambooHR API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("BambooHR API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
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
