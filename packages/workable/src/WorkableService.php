<?php

namespace OpenCompany\Integrations\Workable;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Workable API service for interacting with the Workable ATS REST API (v3/spi).
 *
 * Handles authentication via Bearer token and provides methods for all
 * supported Workable endpoints: jobs, candidates, members, and users.
 */
class WorkableService
{
    /**
     * Create a new WorkableService instance.
     *
     * @param  string  $accessToken  Workable API access token.
     * @param  string  $subdomain    Workable account subdomain.
     * @param  string  $baseUrl      Base URL for the Workable SPI API.
     */
    public function __construct(
        private string $accessToken = '',
        private string $subdomain = '',
        private string $baseUrl = 'https://www.workable.com/spi/v3/accounts',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token and subdomain.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->subdomain);
    }

    /**
     * Get the configured subdomain.
     */
    public function getSubdomain(): string
    {
        return $this->subdomain;
    }

    /**
     * Get the full account base URL used for API requests.
     */
    public function getAccountUrl(): string
    {
        return $this->baseUrl . '/' . $this->subdomain;
    }

    /**
     * List jobs for the account.
     *
     * @param  string|null  $state  Filter by job state: "published", "draft", "closed", "archived".
     * @param  int  $limit  Number of results per page (max 100).
     * @param  int|null  $offset  Offset for pagination.
     * @return array<string, mixed>
     */
    public function listJobs(?string $state = null, int $limit = 50, ?int $offset = null): array
    {
        $params = ['limit' => $limit];
        if ($state !== null) {
            $params['state'] = $state;
        }
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/jobs', $params);
    }

    /**
     * Get details for a specific job by shortcode.
     *
     * @param  string  $shortcode  The job shortcode identifier.
     * @return array<string, mixed>
     */
    public function getJob(string $shortcode): array
    {
        return $this->request('GET', '/jobs/' . urlencode($shortcode));
    }

    /**
     * Create a new job.
     *
     * @param  array<string, mixed>  $data  Job creation payload.
     * @return array<string, mixed>
     */
    public function createJob(array $data): array
    {
        return $this->request('POST', '/jobs', $data);
    }

    /**
     * List candidates for a specific job.
     *
     * @param  string  $shortcode  The job shortcode identifier.
     * @param  int  $limit  Number of results per page (max 100).
     * @param  int|null  $offset  Offset for pagination.
     * @return array<string, mixed>
     */
    public function listCandidates(string $shortcode, int $limit = 50, ?int $offset = null): array
    {
        $params = ['limit' => $limit];
        if ($offset !== null) {
            $params['offset'] = $offset;
        }

        return $this->request('GET', '/jobs/' . urlencode($shortcode) . '/candidates', $params);
    }

    /**
     * Get details for a specific candidate.
     *
     * @param  string  $id  The candidate ID.
     * @return array<string, mixed>
     */
    public function getCandidate(string $id): array
    {
        return $this->request('GET', '/candidates/' . urlencode($id));
    }

    /**
     * List team members (recruiters and hiring managers) for the account.
     *
     * @return array<string, mixed>
     */
    public function listMembers(): array
    {
        return $this->request('GET', '/members');
    }

    /**
     * Get the currently authenticated user's profile.
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
     * @param  string  $path  API path relative to the account URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Workable API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to the account URL.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Workable access token is not configured.');
        }

        if (!$this->subdomain) {
            throw new \RuntimeException('Workable subdomain is not configured.');
        }

        $url = $this->getAccountUrl() . $path;

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

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Workable API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Workable API endpoint not available (HTTP {$response->status()}). Check your subdomain and access token.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Workable API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Workable API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Workable API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Workable API: {$e->getMessage()}");
        }
    }
}
