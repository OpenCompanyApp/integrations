<?php

namespace OpenCompany\Integrations\Kimai;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KimaiService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://demo.kimai.org',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->baseUrl);
    }

    /**
     * List timesheets with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, size, user, project, begin, end, state).
     * @return array<string, mixed>
     */
    public function listTimesheets(array $params = []): array
    {
        return $this->request('GET', '/api/timesheets', $params);
    }

    /**
     * Get a single timesheet entry by ID.
     *
     * @return array<string, mixed>
     */
    public function getTimesheet(int $id): array
    {
        return $this->request('GET', '/api/timesheets/' . $id);
    }

    /**
     * Create a new timesheet entry.
     *
     * @param  array<string, mixed>  $data  Timesheet data (begin, end, project, activity, description).
     * @return array<string, mixed>
     */
    public function createTimesheet(array $data): array
    {
        return $this->request('POST', '/api/timesheets', $data);
    }

    /**
     * List projects with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, size, customer, visible).
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/api/projects', $params);
    }

    /**
     * Get a single project by ID.
     *
     * @return array<string, mixed>
     */
    public function getProject(int $id): array
    {
        return $this->request('GET', '/api/projects/' . $id);
    }

    /**
     * List customers with optional filters.
     *
     * @param  array<string, mixed>  $params  Query parameters (page, size, visible).
     * @return array<string, mixed>
     */
    public function listCustomers(array $params = []): array
    {
        return $this->request('GET', '/api/customers', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Kimai API.
     *
     * @param  array<string, mixed>  $data
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Kimai access token is not configured.');
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
                    Log::warning("Kimai API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Kimai API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Kimai API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Kimai API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Kimai API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Kimai API: {$e->getMessage()}");
        }
    }
}
