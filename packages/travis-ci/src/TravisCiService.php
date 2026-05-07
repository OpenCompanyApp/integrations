<?php

namespace OpenCompany\Integrations\TravisCi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Travis CI API V3.
 *
 * Handles Travis API version headers, token authentication, slug path encoding,
 * response parsing, and normalized API errors.
 */
class TravisCiService
{
    /**
     * @param  string  $apiToken  Travis CI API token.
     * @param  string  $baseUrl  Travis CI API base URL.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.travis-ci.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has a token configured.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiToken) !== '';
    }

    /**
     * Get the authenticated Travis user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * List repositories visible to the current user.
     *
     * @param  array<string, mixed>  $query  Pagination, include, filter, and sort parameters.
     * @return array<string, mixed>
     */
    public function listRepositories(array $query = []): array
    {
        return $this->request('GET', '/repos', $query);
    }

    /**
     * List repositories for an owner login.
     *
     * @param  array<string, mixed>  $query  Pagination, include, filter, and sort parameters.
     * @return array<string, mixed>
     */
    public function listOwnerRepositories(string $provider, string $login, array $query = []): array
    {
        return $this->request('GET', '/owner/'.$this->segment($provider).'/'.$this->segment($login).'/repos', $query);
    }

    /**
     * Get one repository by id or provider/owner/name slug.
     *
     * @param  array<string, mixed>  $query  Optional include query.
     * @return array<string, mixed>
     */
    public function getRepository(string $repository, array $query = []): array
    {
        return $this->request('GET', $this->repoPath($repository), $query);
    }

    /**
     * Activate a repository.
     *
     * @return array<string, mixed>
     */
    public function activateRepository(string $repository): array
    {
        return $this->request('POST', $this->repoPath($repository).'/activate');
    }

    /**
     * Deactivate a repository.
     *
     * @return array<string, mixed>
     */
    public function deactivateRepository(string $repository): array
    {
        return $this->request('POST', $this->repoPath($repository).'/deactivate');
    }

    /**
     * List builds visible to the current user.
     *
     * @param  array<string, mixed>  $query  Pagination, include, and sort parameters.
     * @return array<string, mixed>
     */
    public function listBuilds(array $query = []): array
    {
        return $this->request('GET', '/builds', $query);
    }

    /**
     * List builds for a repository.
     *
     * @param  array<string, mixed>  $query  Build filters, include, pagination, and sort parameters.
     * @return array<string, mixed>
     */
    public function listRepositoryBuilds(string $repository, array $query = []): array
    {
        return $this->request('GET', $this->repoPath($repository).'/builds', $query);
    }

    /**
     * Get one build by id.
     *
     * @param  array<string, mixed>  $query  Optional include query.
     * @return array<string, mixed>
     */
    public function getBuild(int|string $buildId, array $query = []): array
    {
        return $this->request('GET', '/build/'.$this->segment((string) $buildId), $query);
    }

    /**
     * Cancel a running build.
     *
     * @return array<string, mixed>
     */
    public function cancelBuild(int|string $buildId): array
    {
        return $this->request('POST', '/build/'.$this->segment((string) $buildId).'/cancel');
    }

    /**
     * Restart a completed or canceled build.
     *
     * @return array<string, mixed>
     */
    public function restartBuild(int|string $buildId): array
    {
        return $this->request('POST', '/build/'.$this->segment((string) $buildId).'/restart');
    }

    /**
     * List jobs visible to the current user.
     *
     * @param  array<string, mixed>  $query  Job filters, include, pagination, and sort parameters.
     * @return array<string, mixed>
     */
    public function listJobs(array $query = []): array
    {
        return $this->request('GET', '/jobs', $query);
    }

    /**
     * List jobs for one build.
     *
     * @param  array<string, mixed>  $query  Optional include query.
     * @return array<string, mixed>
     */
    public function listBuildJobs(int|string $buildId, array $query = []): array
    {
        return $this->request('GET', '/build/'.$this->segment((string) $buildId).'/jobs', $query);
    }

    /**
     * Get one job by id.
     *
     * @param  array<string, mixed>  $query  Optional include query.
     * @return array<string, mixed>
     */
    public function getJob(int|string $jobId, array $query = []): array
    {
        return $this->request('GET', '/job/'.$this->segment((string) $jobId), $query);
    }

    /**
     * Cancel a running job.
     *
     * @return array<string, mixed>
     */
    public function cancelJob(int|string $jobId): array
    {
        return $this->request('POST', '/job/'.$this->segment((string) $jobId).'/cancel');
    }

    /**
     * Restart a completed or canceled job.
     *
     * @return array<string, mixed>
     */
    public function restartJob(int|string $jobId): array
    {
        return $this->request('POST', '/job/'.$this->segment((string) $jobId).'/restart');
    }

    /**
     * Restart a job in debug mode.
     *
     * @return array<string, mixed>
     */
    public function debugJob(int|string $jobId): array
    {
        return $this->request('POST', '/job/'.$this->segment((string) $jobId).'/debug');
    }

    /**
     * Get a job log.
     *
     * @param  array<string, mixed>  $query  Optional include or log token query.
     * @return array<string, mixed>
     */
    public function getJobLog(int|string $jobId, bool $plainText = false, array $query = []): array
    {
        return $this->request('GET', '/job/'.$this->segment((string) $jobId).'/log'.($plainText ? '.txt' : ''), $query, $plainText);
    }

    /**
     * List build requests for a repository.
     *
     * @param  array<string, mixed>  $query  Request filters, include, and pagination parameters.
     * @return array<string, mixed>
     */
    public function listRequests(string $repository, array $query = []): array
    {
        return $this->request('GET', $this->repoPath($repository).'/requests', $query);
    }

    /**
     * Trigger a build request for a repository.
     *
     * @param  array<string, mixed>  $payload  Travis request payload.
     * @return array<string, mixed>
     */
    public function createRequest(string $repository, array $payload): array
    {
        return $this->request('POST', $this->repoPath($repository).'/requests', $payload);
    }

    /**
     * List repository settings.
     *
     * @param  array<string, mixed>  $query  Optional include query.
     * @return array<string, mixed>
     */
    public function listSettings(string $repository, array $query = []): array
    {
        return $this->request('GET', $this->repoPath($repository).'/settings', $query);
    }

    /**
     * Update a repository setting.
     *
     * @param  array<string, mixed>  $payload  Setting payload.
     * @return array<string, mixed>
     */
    public function updateSetting(string $repository, string $setting, array $payload): array
    {
        return $this->request('PATCH', $this->repoPath($repository).'/setting/'.$this->segment($setting), $payload);
    }

    /**
     * List repository environment variables.
     *
     * @param  array<string, mixed>  $query  Optional include query.
     * @return array<string, mixed>
     */
    public function listEnvVars(string $repository, array $query = []): array
    {
        return $this->request('GET', $this->repoPath($repository).'/env_vars', $query);
    }

    /**
     * Create a repository environment variable.
     *
     * @param  array<string, mixed>  $payload  Environment variable payload.
     * @return array<string, mixed>
     */
    public function createEnvVar(string $repository, array $payload): array
    {
        return $this->request('POST', $this->repoPath($repository).'/env_vars', $payload);
    }

    /**
     * Delete a repository environment variable.
     *
     * @return array<string, mixed>
     */
    public function deleteEnvVar(string $repository, string $envVarId): array
    {
        return $this->request('DELETE', $this->repoPath($repository).'/env_var/'.$this->segment($envVarId));
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
     * Dispatch a Travis CI API request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $plainText = false): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Travis CI API token is required.');
        }

        $response = $this->rawRequest($method, $path, $data, $plainText);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to Travis CI.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $plainText = false): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders([
            'Authorization' => 'token '.$this->apiToken,
            'Travis-API-Version' => '3',
            'Accept' => $plainText ? 'text/plain' : 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported Travis CI method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Travis CI API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Travis CI API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Travis CI API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) ($json['message'] ?? $json['error'] ?? '')
            : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Travis CI API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Travis CI API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode a JSON or text Travis response.
     *
     * @return array<string, mixed>
     */
    private function decodeResponse(Response $response): array
    {
        $body = trim($response->body());
        if ($body === '') {
            return ['success' => true];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['value' => $body];
    }

    private function repoPath(string $repository): string
    {
        $repository = trim($repository, '/');
        if (preg_match('/^\d+$/', $repository) === 1) {
            return '/repo/'.$repository;
        }

        $parts = explode('/', $repository);
        if (count($parts) === 2) {
            array_unshift($parts, 'github');
        }

        return '/repo/'.implode('/', array_map(fn (string $part): string => $this->segment($part), $parts));
    }

    private function segment(string $value): string
    {
        return rawurlencode($value);
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Travis CI API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
