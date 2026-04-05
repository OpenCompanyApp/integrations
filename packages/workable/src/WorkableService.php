<?php

namespace OpenCompany\Integrations\Workable;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Workable API service for interacting with the Workable ATS.
 *
 * Handles authentication and HTTP communication with the Workable SPI v3 API.
 * Base URL pattern: https://www.workable.com/spi/v3/accounts/{subdomain}
 */
class WorkableService
{
    /**
     * Create a new WorkableService instance.
     *
     * @param  string  $accessToken  Workable API access token.
     * @param  string  $subdomain    Workable account subdomain.
     */
    public function __construct(
        private string $accessToken = '',
        private string $subdomain = '',
    ) {}

    /**
     * Check whether the service is properly configured with credentials.
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
     * List jobs for the account.
     *
     * @param  string|null  $state  Filter by job state (e.g., "published", "draft", "archived", "closed").
     * @param  int  $limit   Maximum number of jobs to return.
     * @return array<string, mixed>
     */
    public function listJobs(?string $state = null, int $limit = 50): array
    {
        $params = ['limit' => $limit];
        if ($state !== null) {
            $params['state'] = $state;
        }

        return $this->request('GET', '/jobs', $params);
    }

    /**
     * Get details for a specific job.
     *
     * @param  string  $shortcode  The job shortcode identifier.
     * @return array<string, mixed>
     */
    public function getJob(string $shortcode): array
    {
        return $this->request('GET', '/jobs/' . urlencode($shortcode));
    }

    /**
     * List candidates for a specific job.
     *
     * @param  string  $shortcode  The job shortcode identifier.
     * @param  int     $limit      Maximum number of candidates to return.
     * @return array<string, mixed>
     */
    public function listCandidates(string $shortcode, int $limit = 50): array
    {
        return $this->request('GET', '/jobs/' . urlencode($shortcode) . '/candidates', [
            'limit' => $limit,
        ]);
    }

    /**
     * Get details for a specific candidate.
     *
     * @param  string  $id  The candidate identifier.
     * @return array<string, mixed>
     */
    public function getCandidate(string $id): array
    {
        return $this->request('GET', '/candidates/' . urlencode($id));
    }

    /**
     * Create a new candidate for a specific job.
     *
     * @param  string  $shortcode  The job shortcode to apply the candidate to.
     * @param  string  $name       The candidate's full name.
     * @param  string  $email      The candidate's email address.
     * @param  array   $additional  Additional candidate fields (e.g., phone, headline, address, cover_letter).
     * @return array<string, mixed>
     */
    public function createCandidate(string $shortcode, string $name, string $email, array $additional = []): array
    {
        $data = array_merge([
            'name' => $name,
            'email' => $email,
        ], $additional);

        return $this->request('POST', '/jobs/' . urlencode($shortcode) . '/candidates', $data);
    }

    /**
     * List members (team members) for the account.
     *
     * @param  int  $limit  Maximum number of members to return.
     * @return array<string, mixed>
     */
    public function listMembers(int $limit = 50): array
    {
        return $this->request('GET', '/members', [
            'limit' => $limit,
        ]);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API path relative to the account base URL.
     * @param  array   $data    Query parameters or request body.
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
     * @param  string  $path    API path relative to the account base URL.
     * @param  array   $data    Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If credentials are missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken || !$this->subdomain) {
            throw new \RuntimeException('Workable access token and subdomain are not configured.');
        }

        $url = 'https://www.workable.com/spi/v3/accounts/' . $this->subdomain . $path;

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
