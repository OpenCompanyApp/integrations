<?php

namespace OpenCompany\Integrations\Buildkite;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Buildkite REST API v2.
 *
 * Handles bearer-token authentication, safe relative paths, query/body
 * dispatch, response parsing, and normalized API errors.
 */
class BuildkiteService
{
    /**
     * @param  string  $accessToken  Buildkite API access token.
     * @param  string  $baseUrl  Buildkite REST API v2 base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.buildkite.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has a token configured.
     */
    public function isConfigured(): bool
    {
        return trim($this->accessToken) !== '';
    }

    /**
     * Get the authenticated Buildkite user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * List organizations accessible to the token.
     *
     * @param  array<string, mixed>  $query  Pagination query parameters.
     * @return array<string, mixed>
     */
    public function listOrganizations(array $query = []): array
    {
        return $this->request('GET', '/organizations', $query);
    }

    /**
     * Get one organization by slug.
     *
     * @return array<string, mixed>
     */
    public function getOrganization(string $organization): array
    {
        return $this->request('GET', '/organizations/'.$this->segment($organization));
    }

    /**
     * List pipelines in an organization.
     *
     * @param  array<string, mixed>  $query  Pagination and filter query parameters.
     * @return array<string, mixed>
     */
    public function listPipelines(string $organization, array $query = []): array
    {
        return $this->request('GET', '/organizations/'.$this->segment($organization).'/pipelines', $query);
    }

    /**
     * Get one pipeline by slug.
     *
     * @return array<string, mixed>
     */
    public function getPipeline(string $organization, string $pipeline): array
    {
        return $this->request('GET', $this->pipelinePath($organization, $pipeline));
    }

    /**
     * Create a pipeline.
     *
     * @param  array<string, mixed>  $payload  Pipeline creation fields.
     * @return array<string, mixed>
     */
    public function createPipeline(string $organization, array $payload): array
    {
        return $this->request('POST', '/organizations/'.$this->segment($organization).'/pipelines', $payload);
    }

    /**
     * Update a pipeline.
     *
     * @param  array<string, mixed>  $payload  Pipeline update fields.
     * @return array<string, mixed>
     */
    public function updatePipeline(string $organization, string $pipeline, array $payload): array
    {
        return $this->request('PATCH', $this->pipelinePath($organization, $pipeline), $payload);
    }

    /**
     * Archive a pipeline.
     *
     * @return array<string, mixed>
     */
    public function archivePipeline(string $organization, string $pipeline): array
    {
        return $this->request('DELETE', $this->pipelinePath($organization, $pipeline));
    }

    /**
     * Unarchive a pipeline.
     *
     * @return array<string, mixed>
     */
    public function unarchivePipeline(string $organization, string $pipeline): array
    {
        return $this->request('PATCH', $this->pipelinePath($organization, $pipeline).'/unarchive');
    }

    /**
     * List builds for a pipeline.
     *
     * @param  array<string, mixed>  $query  Build filters and pagination parameters.
     * @return array<string, mixed>
     */
    public function listBuilds(string $organization, string $pipeline, array $query = []): array
    {
        return $this->request('GET', $this->pipelinePath($organization, $pipeline).'/builds', $query);
    }

    /**
     * Get one build by build number.
     *
     * @return array<string, mixed>
     */
    public function getBuild(string $organization, string $pipeline, int|string $number): array
    {
        return $this->request('GET', $this->buildPath($organization, $pipeline, $number));
    }

    /**
     * Create a build.
     *
     * @param  array<string, mixed>  $payload  Build creation payload.
     * @return array<string, mixed>
     */
    public function createBuild(string $organization, string $pipeline, array $payload): array
    {
        return $this->request('POST', $this->pipelinePath($organization, $pipeline).'/builds', $payload);
    }

    /**
     * Cancel a build by build number.
     *
     * @return array<string, mixed>
     */
    public function cancelBuild(string $organization, string $pipeline, int|string $number): array
    {
        return $this->request('PUT', $this->buildPath($organization, $pipeline, $number).'/cancel');
    }

    /**
     * Rebuild a build by build number.
     *
     * @return array<string, mixed>
     */
    public function rebuildBuild(string $organization, string $pipeline, int|string $number): array
    {
        return $this->request('PUT', $this->buildPath($organization, $pipeline, $number).'/rebuild');
    }

    /**
     * Retry failed jobs for a build.
     *
     * @param  array<string, mixed>  $payload  Optional states payload.
     * @return array<string, mixed>
     */
    public function retryFailedJobs(string $organization, string $pipeline, int|string $number, array $payload = []): array
    {
        return $this->request('PUT', $this->buildPath($organization, $pipeline, $number).'/retry_failed_jobs', $payload);
    }

    /**
     * Get a job log.
     *
     * @return array<string, mixed>
     */
    public function getJobLog(string $organization, string $pipeline, int|string $number, string $jobId): array
    {
        return $this->request('GET', $this->buildPath($organization, $pipeline, $number).'/jobs/'.$this->segment($jobId).'/log');
    }

    /**
     * Get a job environment.
     *
     * @return array<string, mixed>
     */
    public function getJobEnvironment(string $organization, string $pipeline, int|string $number, string $jobId): array
    {
        return $this->request('GET', $this->buildPath($organization, $pipeline, $number).'/jobs/'.$this->segment($jobId).'/env');
    }

    /**
     * Execute a safe raw GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Execute a safe raw POST request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a safe raw PUT request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $query);
    }

    /**
     * Dispatch a Buildkite API request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204 || trim($response->body()) === '') {
            return [];
        }

        $json = $response->json();

        return is_array($json) ? $json : ['body' => $response->body()];
    }

    /**
     * Make a raw HTTP request to Buildkite.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON body.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Buildkite access token is required.');
        }

        $method = strtoupper($method);
        $url = $this->baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match ($method) {
                'GET' => $http->get($url, $this->filterQuery($data)),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->send('DELETE', $url, ['query' => $this->filterQuery($data)]),
                default => throw new RuntimeException("Unsupported Buildkite method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Buildkite API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Buildkite API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Buildkite API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? ($json['message'] ?? $json['error'] ?? $json['errors'][0] ?? null)
            : null;
        $message = is_string($message) && $message !== '' ? $message : trim($response->body());

        Log::error("Buildkite API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $message,
        ]);

        throw new RuntimeException('Buildkite API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Build a pipeline-relative path.
     */
    private function pipelinePath(string $organization, string $pipeline): string
    {
        return '/organizations/'.$this->segment($organization).'/pipelines/'.$this->segment($pipeline);
    }

    /**
     * Build a build-relative path.
     */
    private function buildPath(string $organization, string $pipeline, int|string $number): string
    {
        return $this->pipelinePath($organization, $pipeline).'/builds/'.$this->segment((string) $number);
    }

    /**
     * Normalize a raw helper path and reject absolute URLs.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_contains($path, '://') || str_contains($path, '..')) {
            throw new RuntimeException('Buildkite API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }

    /**
     * Encode one path segment.
     */
    private function segment(string $value): string
    {
        return rawurlencode($value);
    }

    /**
     * Remove empty query values while preserving false and zero.
     *
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function filterQuery(array $query): array
    {
        return array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');
    }
}
