<?php

namespace OpenCompany\Integrations\Jenkins;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Jenkins REST API.
 *
 * Provides methods for jobs, builds, nodes, and user information.
 */
class JenkinsService
{
    private const BASE_URL = 'https://api.jenkins.io/v1';

    /**
     * @param  string  $apiToken  Jenkins API Bearer token
     */
    public function __construct(
        private string $apiToken = '',
    ) {}

    /**
     * Check whether the Jenkins API token has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    /*-----------------------------------------------------------------------
     | Jobs
     *---------------------------------------------------------------------*/

    /**
     * List all Jenkins jobs.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listJobs(array $params = []): array
    {
        return $this->request('GET', '/jobs', $params);
    }

    /**
     * Get details for a specific Jenkins job.
     *
     * @return array<string, mixed>
     */
    public function getJob(string $jobName): array
    {
        return $this->request('GET', "/jobs/{$jobName}");
    }

    /**
     * Create a new Jenkins job.
     *
     * @param  array<string, mixed>  $params  Job configuration
     * @return array<string, mixed>
     */
    public function createJob(array $params): array
    {
        return $this->request('POST', '/jobs', $params);
    }

    /*-----------------------------------------------------------------------
     | Builds
     *---------------------------------------------------------------------*/

    /**
     * List builds for a specific Jenkins job.
     *
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<string, mixed>
     */
    public function listBuilds(string $jobName, array $params = []): array
    {
        return $this->request('GET', "/jobs/{$jobName}/builds", $params);
    }

    /**
     * Get details for a specific build.
     *
     * @return array<string, mixed>
     */
    public function getBuild(string $jobName, int $buildNumber): array
    {
        return $this->request('GET', "/jobs/{$jobName}/builds/{$buildNumber}");
    }

    /*-----------------------------------------------------------------------
     | Nodes
     *---------------------------------------------------------------------*/

    /**
     * List all Jenkins nodes (agents).
     *
     * @return array<string, mixed>
     */
    public function listNodes(): array
    {
        return $this->request('GET', '/nodes');
    }

    /*-----------------------------------------------------------------------
     | User
     *---------------------------------------------------------------------*/

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    /**
     * Make an authenticated API request to Jenkins.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('Jenkins API token is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiToken}",
                'Accept' => 'application/json',
            ])->timeout(30);

            $url = self::BASE_URL . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'PATCH' => $http->patch($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 429) {
                throw new \RuntimeException('Jenkins API rate limit exceeded.');
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $response->body();

                Log::error("Jenkins API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Jenkins API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Jenkins API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Jenkins API: {$e->getMessage()}");
        }
    }
}
