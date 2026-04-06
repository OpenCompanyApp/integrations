<?php

namespace OpenCompany\Integrations\Freshteam;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FreshteamService
{
    public function __construct(
        private string $accessToken = '',
        private string $domain = '',
    ) {
        $this->domain = rtrim($this->domain, '/');
    }

    /**
     * Check whether the Freshteam integration is configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->domain);
    }

    /**
     * Build the base URL from the configured domain.
     *
     * @return string e.g. "https://acme.freshteam.com"
     */
    public function getBaseUrl(): string
    {
        return 'https://' . $this->domain . '.freshteam.com';
    }

    /**
     * List candidates with optional pagination and status filter.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page.
     * @param  string|null  $status  Filter by candidate status.
     * @return array<string, mixed>
     */
    public function listCandidates(int $page = 1, int $perPage = 20, ?string $status = null): array
    {
        $params = ['page' => $page, 'per_page' => $perPage];
        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/api/candidates', $params);
    }

    /**
     * Get a single candidate by ID.
     *
     * @param  int  $id  The candidate ID.
     * @return array<string, mixed>
     */
    public function getCandidate(int $id): array
    {
        return $this->request('GET', '/api/candidates/' . $id);
    }

    /**
     * List job postings with optional pagination, status, and department filter.
     *
     * @param  int  $page          Page number (1-based).
     * @param  int  $perPage       Results per page.
     * @param  string|null  $status        Filter by job posting status.
     * @param  int|null  $departmentId  Filter by department ID.
     * @return array<string, mixed>
     */
    public function listJobPostings(int $page = 1, int $perPage = 20, ?string $status = null, ?int $departmentId = null): array
    {
        $params = ['page' => $page, 'per_page' => $perPage];
        if ($status !== null) {
            $params['status'] = $status;
        }
        if ($departmentId !== null) {
            $params['department_id'] = $departmentId;
        }

        return $this->request('GET', '/api/job_postings', $params);
    }

    /**
     * Get a single job posting by ID.
     *
     * @param  int  $id  The job posting ID.
     * @return array<string, mixed>
     */
    public function getJobPosting(int $id): array
    {
        return $this->request('GET', '/api/job_postings/' . $id);
    }

    /**
     * List employees with optional pagination and department filter.
     *
     * @param  int  $page     Page number (1-based).
     * @param  int  $perPage  Results per page.
     * @param  int|null  $departmentId  Filter by department ID.
     * @return array<string, mixed>
     */
    public function listEmployees(int $page = 1, int $perPage = 20, ?int $departmentId = null): array
    {
        $params = ['page' => $page, 'per_page' => $perPage];
        if ($departmentId !== null) {
            $params['department_id'] = $departmentId;
        }

        return $this->request('GET', '/api/employees', $params);
    }

    /**
     * Get a single employee by ID.
     *
     * @param  int  $id  The employee ID.
     * @return array<string, mixed>
     */
    public function getEmployee(int $id): array
    {
        return $this->request('GET', '/api/employees/' . $id);
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
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path (e.g. "/api/candidates").
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Freshteam API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Freshteam access token is not configured.');
        }

        if (!$this->domain) {
            throw new \RuntimeException('Freshteam domain is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

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
                    Log::warning("Freshteam API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Freshteam API endpoint not available (HTTP {$response->status()}). Check your domain configuration.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Freshteam API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Freshteam API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Freshteam API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Freshteam API: {$e->getMessage()}");
        }
    }
}
