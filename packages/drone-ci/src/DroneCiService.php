<?php

namespace OpenCompany\Integrations\DroneCi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Drone remote API.
 *
 * Handles bearer-token authentication, owner/repository path encoding, JSON
 * response parsing, and normalized API errors.
 */
class DroneCiService
{
    /**
     * @param  string  $accessToken  Drone access token.
     * @param  string  $baseUrl  Drone server URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return trim($this->accessToken) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Get the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/api/user');
    }

    /**
     * Get the authenticated user's activity feed.
     *
     * @param  array<string, mixed>  $query  Pagination query parameters.
     * @return array<string, mixed>
     */
    public function getCurrentUserFeed(array $query = []): array
    {
        return $this->request('GET', '/api/user/feed', $query);
    }

    /**
     * List repositories registered to the authenticated user.
     *
     * @param  array<string, mixed>  $query  Pagination query parameters.
     * @return array<string, mixed>
     */
    public function listCurrentUserRepos(array $query = []): array
    {
        return $this->request('GET', '/api/user/repos', $query);
    }

    /**
     * Sync authenticated user repositories.
     *
     * @return array<string, mixed>
     */
    public function syncCurrentUser(): array
    {
        return $this->request('POST', '/api/user/repos');
    }

    /**
     * Get one repository.
     *
     * @return array<string, mixed>
     */
    public function getRepo(string $owner, string $repo): array
    {
        return $this->request('GET', $this->repoPath($owner, $repo));
    }

    /**
     * Enable one repository.
     *
     * @return array<string, mixed>
     */
    public function enableRepo(string $owner, string $repo): array
    {
        return $this->request('POST', $this->repoPath($owner, $repo));
    }

    /**
     * Update one repository.
     *
     * @param  array<string, mixed>  $payload  Repository settings payload.
     * @return array<string, mixed>
     */
    public function updateRepo(string $owner, string $repo, array $payload): array
    {
        return $this->request('PATCH', $this->repoPath($owner, $repo), $payload);
    }

    /**
     * Disable one repository.
     *
     * @return array<string, mixed>
     */
    public function disableRepo(string $owner, string $repo): array
    {
        return $this->request('DELETE', $this->repoPath($owner, $repo));
    }

    /**
     * Repair repository webhooks.
     *
     * @return array<string, mixed>
     */
    public function repairRepo(string $owner, string $repo): array
    {
        return $this->request('POST', $this->repoPath($owner, $repo).'/repair');
    }

    /**
     * Change repository ownership.
     *
     * @return array<string, mixed>
     */
    public function chownRepo(string $owner, string $repo): array
    {
        return $this->request('POST', $this->repoPath($owner, $repo).'/chown');
    }

    /**
     * List builds for a repository.
     *
     * @param  array<string, mixed>  $query  Pagination query parameters.
     * @return array<string, mixed>
     */
    public function listBuilds(string $owner, string $repo, array $query = []): array
    {
        return $this->request('GET', $this->repoPath($owner, $repo).'/builds', $query);
    }

    /**
     * Create a custom build.
     *
     * @param  array<string, mixed>  $query  Branch, commit, and parameter query values.
     * @return array<string, mixed>
     */
    public function createBuild(string $owner, string $repo, array $query = []): array
    {
        return $this->request('POST', $this->repoPath($owner, $repo).'/builds', $query, true);
    }

    /**
     * Get one build.
     *
     * @return array<string, mixed>
     */
    public function getBuild(string $owner, string $repo, int|string $build): array
    {
        return $this->request('GET', $this->buildPath($owner, $repo, $build));
    }

    /**
     * Restart one build.
     *
     * @return array<string, mixed>
     */
    public function restartBuild(string $owner, string $repo, int|string $build): array
    {
        return $this->request('POST', $this->buildPath($owner, $repo, $build).'/restart');
    }

    /**
     * Stop one build.
     *
     * @return array<string, mixed>
     */
    public function stopBuild(string $owner, string $repo, int|string $build): array
    {
        return $this->request('DELETE', $this->buildPath($owner, $repo, $build));
    }

    /**
     * Approve one blocked build.
     *
     * @return array<string, mixed>
     */
    public function approveBuild(string $owner, string $repo, int|string $build): array
    {
        return $this->request('POST', $this->buildPath($owner, $repo, $build).'/approve');
    }

    /**
     * Decline one blocked build.
     *
     * @return array<string, mixed>
     */
    public function declineBuild(string $owner, string $repo, int|string $build): array
    {
        return $this->request('POST', $this->buildPath($owner, $repo, $build).'/decline');
    }

    /**
     * Promote one build to a target environment.
     *
     * @param  array<string, mixed>  $query  Target and parameter query values.
     * @return array<string, mixed>
     */
    public function promoteBuild(string $owner, string $repo, int|string $build, array $query = []): array
    {
        return $this->request('POST', $this->buildPath($owner, $repo, $build).'/promote', $query, true);
    }

    /**
     * Get build logs for one stage and step.
     *
     * @return array<string, mixed>
     */
    public function getBuildLogs(string $owner, string $repo, int|string $build, int|string $stage, int|string $step): array
    {
        return $this->request('GET', $this->buildPath($owner, $repo, $build).'/logs/'.$this->segment((string) $stage).'/'.$this->segment((string) $step));
    }

    /**
     * List repository cron jobs.
     *
     * @return array<string, mixed>
     */
    public function listCron(string $owner, string $repo): array
    {
        return $this->request('GET', $this->repoPath($owner, $repo).'/cron');
    }

    /**
     * Create a repository cron job.
     *
     * @param  array<string, mixed>  $payload  Cron payload.
     * @return array<string, mixed>
     */
    public function createCron(string $owner, string $repo, array $payload): array
    {
        return $this->request('POST', $this->repoPath($owner, $repo).'/cron', $payload);
    }

    /**
     * Get one repository cron job.
     *
     * @return array<string, mixed>
     */
    public function getCron(string $owner, string $repo, string $name): array
    {
        return $this->request('GET', $this->repoPath($owner, $repo).'/cron/'.$this->segment($name));
    }

    /**
     * Update one repository cron job.
     *
     * @param  array<string, mixed>  $payload  Cron payload.
     * @return array<string, mixed>
     */
    public function updateCron(string $owner, string $repo, string $name, array $payload): array
    {
        return $this->request('PATCH', $this->repoPath($owner, $repo).'/cron/'.$this->segment($name), $payload);
    }

    /**
     * Delete one repository cron job.
     *
     * @return array<string, mixed>
     */
    public function deleteCron(string $owner, string $repo, string $name): array
    {
        return $this->request('DELETE', $this->repoPath($owner, $repo).'/cron/'.$this->segment($name));
    }

    /**
     * Trigger one repository cron job.
     *
     * @return array<string, mixed>
     */
    public function triggerCron(string $owner, string $repo, string $name): array
    {
        return $this->request('POST', $this->repoPath($owner, $repo).'/cron/'.$this->segment($name));
    }

    /**
     * List repository secrets.
     *
     * @return array<string, mixed>
     */
    public function listSecrets(string $owner, string $repo): array
    {
        return $this->request('GET', $this->repoPath($owner, $repo).'/secrets');
    }

    /**
     * Create a repository secret.
     *
     * @param  array<string, mixed>  $payload  Secret payload.
     * @return array<string, mixed>
     */
    public function createSecret(string $owner, string $repo, array $payload): array
    {
        return $this->request('POST', $this->repoPath($owner, $repo).'/secrets', $payload);
    }

    /**
     * Get one repository secret.
     *
     * @return array<string, mixed>
     */
    public function getSecret(string $owner, string $repo, string $name): array
    {
        return $this->request('GET', $this->repoPath($owner, $repo).'/secrets/'.$this->segment($name));
    }

    /**
     * Update one repository secret.
     *
     * @param  array<string, mixed>  $payload  Secret payload.
     * @return array<string, mixed>
     */
    public function updateSecret(string $owner, string $repo, string $name, array $payload): array
    {
        return $this->request('PATCH', $this->repoPath($owner, $repo).'/secrets/'.$this->segment($name), $payload);
    }

    /**
     * Delete one repository secret.
     *
     * @return array<string, mixed>
     */
    public function deleteSecret(string $owner, string $repo, string $name): array
    {
        return $this->request('DELETE', $this->repoPath($owner, $repo).'/secrets/'.$this->segment($name));
    }

    /**
     * List Drone users.
     *
     * @return array<string, mixed>
     */
    public function listUsers(): array
    {
        return $this->request('GET', '/api/users');
    }

    /**
     * Get one Drone user.
     *
     * @return array<string, mixed>
     */
    public function getUser(string $login): array
    {
        return $this->request('GET', '/api/users/'.$this->segment($login));
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
     * Dispatch a Drone API request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $asQuery = false): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Drone CI URL and access token are required.');
        }

        $response = $this->rawRequest($method, $path, $data, $asQuery);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to Drone.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $asQuery = false): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->accessToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(30);

        if ($asQuery && $data !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?').http_build_query($data);
            $data = [];
        }

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported Drone CI method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Drone CI API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Drone CI API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Drone API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Drone CI API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Drone CI API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode a JSON or text Drone response.
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

    private function repoPath(string $owner, string $repo): string
    {
        return '/api/repos/'.$this->segment($owner).'/'.$this->segment($repo);
    }

    private function buildPath(string $owner, string $repo, int|string $build): string
    {
        return $this->repoPath($owner, $repo).'/builds/'.$this->segment((string) $build);
    }

    private function segment(string $value): string
    {
        return rawurlencode($value);
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Drone CI API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
