<?php

namespace OpenCompany\Integrations\Ashby;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AshbyService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.ashbyhq.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List jobs via POST /job.list.
     *
     * @param  array  $body  Request body (filters, pagination, etc.).
     * @return array<string, mixed>
     */
    public function listJobs(array $body = []): array
    {
        return $this->request('POST', '/job.list', $body);
    }

    /**
     * Get detailed info for a single job via POST /job.getInfo.
     *
     * @param  array  $body  Request body containing jobId or similar identifier.
     * @return array<string, mixed>
     */
    public function getJob(array $body): array
    {
        return $this->request('POST', '/job.getInfo', $body);
    }

    /**
     * List applications via POST /application.list.
     *
     * @param  array  $body  Request body (filters, pagination, etc.).
     * @return array<string, mixed>
     */
    public function listApplications(array $body = []): array
    {
        return $this->request('POST', '/application.list', $body);
    }

    /**
     * Get detailed info for a single application via POST /application.getInfo.
     *
     * @param  array  $body  Request body containing applicationId or similar identifier.
     * @return array<string, mixed>
     */
    public function getApplication(array $body): array
    {
        return $this->request('POST', '/application.getInfo', $body);
    }

    /**
     * List candidates via POST /candidate.list.
     *
     * @param  array  $body  Request body (filters, pagination, etc.).
     * @return array<string, mixed>
     */
    public function listCandidates(array $body = []): array
    {
        return $this->request('POST', '/candidate.list', $body);
    }

    /**
     * Create a note via POST /note.create.
     *
     * @param  array  $body  Request body containing subjectId, content, etc.
     * @return array<string, mixed>
     */
    public function createNote(array $body): array
    {
        return $this->request('POST', '/note.create', $body);
    }

    /**
     * List interviews via POST /interview.list.
     *
     * @param  array  $body  Request body (filters, pagination, etc.).
     * @return array<string, mixed>
     */
    public function listInterviews(array $body = []): array
    {
        return $this->request('POST', '/interview.list', $body);
    }

    /**
     * Get current user info via POST /user.getInfo.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('POST', '/user.getInfo');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (POST, GET, etc.).
     * @param  string  $path    API endpoint path (e.g., /job.list).
     * @param  array   $data    Request body for POST requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Ashby API.
     *
     * Uses HTTP Basic authentication with the API key as the username and an empty password.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the API key is missing, the connection fails, or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Ashby API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
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
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Ashby API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Ashby API endpoint not available (HTTP {$response->status()}). Check the API URL and credentials.");
                }

                $error = $response->json('errors') ?? $response->json('error') ?? $body;
                Log::error("Ashby API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Ashby API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Ashby API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Ashby API: {$e->getMessage()}");
        }
    }
}
