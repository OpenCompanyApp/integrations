<?php

namespace OpenCompany\Integrations\Ashby;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Ashby ATS API service.
 *
 * Handles authenticated requests to the Ashby HQ REST API.
 * Public endpoints use POST with JSON bodies and RPC-style paths such as
 * /candidate.list. Authentication is HTTP Basic with the API key as username.
 *
 * @see https://developers.ashbyhq.com
 */
class AshbyService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.ashbyhq.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Execute a raw POST request against an Ashby API endpoint.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $endpoint, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($endpoint), $payload);
    }

    /**
     * List applications with optional filters.
     *
     * @param  int|null  $limit   Maximum number of results to return.
     * @param  int|null  $offset  Number of results to skip.
     * @param  string|null  $jobId  Filter by job ID.
     * @param  string|null  $status  Filter by application status.
     * @return array<string, mixed>
     */
    public function listApplications(?int $limit = null, ?int $offset = null, ?string $jobId = null, ?string $status = null): array
    {
        $body = [];
        if ($limit !== null) {
            $body['limit'] = $limit;
        }
        if ($offset !== null) {
            $body['offset'] = $offset;
        }
        if ($jobId !== null) {
            $body['jobId'] = $jobId;
        }
        if ($status !== null) {
            $body['status'] = $status;
        }

        return $this->apiPost('/application.list', $body);
    }

    /**
     * Get a single application by ID.
     *
     * @param  string  $id  The application ID.
     * @return array<string, mixed>
     */
    public function getApplication(string $id): array
    {
        return $this->apiPost('/application.info', [
            'applicationId' => $id,
        ]);
    }

    /**
     * List jobs with optional filters.
     *
     * @param  int|null  $limit   Maximum number of results to return.
     * @param  int|null  $offset  Number of results to skip.
     * @param  string|null  $status  Filter by job status.
     * @return array<string, mixed>
     */
    public function listJobs(?int $limit = null, ?int $offset = null, ?string $status = null): array
    {
        $body = [];
        if ($limit !== null) {
            $body['limit'] = $limit;
        }
        if ($offset !== null) {
            $body['offset'] = $offset;
        }
        if ($status !== null) {
            $body['status'] = $status;
        }

        return $this->apiPost('/job.list', $body);
    }

    /**
     * Get a single job by ID.
     *
     * @param  string  $id  The job ID.
     * @return array<string, mixed>
     */
    public function getJob(string $id): array
    {
        return $this->apiPost('/job.info', [
            'jobId' => $id,
        ]);
    }

    /**
     * List interviews with optional filters.
     *
     * @param  int|null  $limit          Maximum number of results to return.
     * @param  int|null  $offset         Number of results to skip.
     * @param  string|null  $applicationId  Filter by application ID.
     * @return array<string, mixed>
     */
    public function listInterviews(?int $limit = null, ?int $offset = null, ?string $applicationId = null): array
    {
        $body = [];
        if ($limit !== null) {
            $body['limit'] = $limit;
        }
        if ($offset !== null) {
            $body['offset'] = $offset;
        }
        if ($applicationId !== null) {
            $body['applicationId'] = $applicationId;
        }

        return $this->apiPost('/interview.list', $body);
    }

    /**
     * Get a single interview by ID.
     *
     * @param  string  $id  The interview ID.
     * @return array<string, mixed>
     */
    public function getInterview(string $id): array
    {
        return $this->apiPost('/interview.info', [
            'interviewId' => $id,
        ]);
    }

    /**
     * List candidates.
     *
     * @param  array<string, mixed>  $params  Candidate list body parameters.
     * @return array<string, mixed>
     */
    public function listCandidates(array $params = []): array
    {
        return $this->apiPost('/candidate.list', $params);
    }

    /**
     * Create a note on a candidate.
     *
     * @param  array<string, mixed>  $params  Candidate note body parameters.
     * @return array<string, mixed>
     */
    public function createNote(array $params): array
    {
        return $this->apiPost('/candidate.createNote', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiPost('/user.me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (POST).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Request body parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        $json = $response->json();

        if (!is_array($json)) {
            return [];
        }

        return $json;
    }

    /**
     * Normalize a user-supplied endpoint to an Ashby root RPC path.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '') {
            throw new \RuntimeException('Ashby API endpoint is required.');
        }

        if (str_starts_with($path, $this->baseUrl)) {
            $path = substr($path, strlen($this->baseUrl));
        }

        if (str_starts_with($path, '/api/v1/')) {
            $path = '/' . substr($path, strlen('/api/v1/'));
        }

        return '/' . ltrim($path, '/');
    }

    /**
     * Make a raw HTTP request to the Ashby API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Request body parameters.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Ashby access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($this->accessToken, '')->timeout(30);

            $response = match (strtoupper($method)) {
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('errors') ?? $response->json('error') ?? $response->body();
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
