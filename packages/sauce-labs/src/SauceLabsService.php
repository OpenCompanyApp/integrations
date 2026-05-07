<?php

namespace OpenCompany\Integrations\SauceLabs;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Sauce Labs REST APIs.
 *
 * Handles regional base URLs, basic authentication, JSON and text response
 * parsing, and normalized API errors across platform, jobs, builds, RDC, and tunnels.
 */
class SauceLabsService
{
    /**
     * @param  string  $username  Sauce Labs username or service account username.
     * @param  string  $accessKey  Sauce Labs access key.
     * @param  string  $baseUrl  Sauce Labs regional API base URL.
     */
    public function __construct(
        private string $username = '',
        private string $accessKey = '',
        private string $baseUrl = 'https://api.us-west-1.saucelabs.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: 'https://api.us-west-1.saucelabs.com', '/');
    }

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return trim($this->username) !== '' && trim($this->accessKey) !== '';
    }

    /**
     * Get Sauce Labs platform status.
     *
     * @return array<string, mixed>
     */
    public function getStatus(): array { return $this->request('GET', '/rest/v1/info/status'); }

    /**
     * List supported Sauce Labs platforms.
     *
     * @return array<string, mixed>
     */
    public function listPlatforms(string $automationApi = 'all'): array { return $this->request('GET', '/rest/v1/info/platforms/'.$this->segment($automationApi)); }

    /**
     * List VDC jobs for a user.
     *
     * @param  array<string, mixed>  $query  Job filters.
     * @return array<string, mixed>
     */
    public function listJobs(string $username = '', array $query = []): array { return $this->request('GET', $this->userPath($username).'/jobs', $query); }

    /**
     * Get one VDC job.
     *
     * @return array<string, mixed>
     */
    public function getJob(string $username, string $jobId): array { return $this->request('GET', $this->jobPath($username, $jobId)); }

    /**
     * Update one VDC job.
     *
     * @param  array<string, mixed>  $payload  Job update payload.
     * @return array<string, mixed>
     */
    public function updateJob(string $username, string $jobId, array $payload): array { return $this->request('PUT', $this->jobPath($username, $jobId), $payload); }

    /**
     * Stop one VDC job.
     *
     * @return array<string, mixed>
     */
    public function stopJob(string $username, string $jobId): array { return $this->request('PUT', $this->jobPath($username, $jobId).'/stop'); }

    /**
     * Delete one VDC job.
     *
     * @return array<string, mixed>
     */
    public function deleteJob(string $username, string $jobId): array { return $this->request('DELETE', $this->jobPath($username, $jobId)); }

    /**
     * List VDC job assets.
     *
     * @return array<string, mixed>
     */
    public function listJobAssets(string $username, string $jobId): array { return $this->request('GET', $this->jobPath($username, $jobId).'/assets'); }

    /**
     * Get a VDC job asset file.
     *
     * @return array<string, mixed>
     */
    public function getJobAsset(string $username, string $jobId, string $fileName): array { return $this->request('GET', $this->jobPath($username, $jobId).'/assets/'.$this->path($fileName)); }

    /**
     * List v2 builds for a build source.
     *
     * @param  array<string, mixed>  $query  Build filters.
     * @return array<string, mixed>
     */
    public function listBuilds(string $buildSource, array $query = []): array { return $this->request('GET', '/v2/builds/'.$this->segment($buildSource).'/', $query); }

    /**
     * Get one v2 build.
     *
     * @return array<string, mixed>
     */
    public function getBuild(string $buildSource, string $buildId): array { return $this->request('GET', '/v2/builds/'.$this->segment($buildSource).'/'.$this->segment($buildId).'/'); }

    /**
     * Lookup the build for a known job.
     *
     * @return array<string, mixed>
     */
    public function getJobBuild(string $buildSource, string $jobId): array { return $this->request('GET', '/v2/builds/'.$this->segment($buildSource).'/jobs/'.$this->segment($jobId).'/build/'); }

    /**
     * List jobs in a v2 build.
     *
     * @param  array<string, mixed>  $query  Job filters.
     * @return array<string, mixed>
     */
    public function listBuildJobs(string $buildSource, string $buildId, array $query = []): array { return $this->request('GET', '/v2/builds/'.$this->segment($buildSource).'/'.$this->segment($buildId).'/jobs/', $query); }

    /**
     * List real device jobs.
     *
     * @param  array<string, mixed>  $query  Job filters.
     * @return array<string, mixed>
     */
    public function listRdcJobs(array $query = []): array { return $this->request('GET', '/v1/rdc/jobs', $query); }

    /**
     * Get one real device job.
     *
     * @return array<string, mixed>
     */
    public function getRdcJob(string $jobId): array { return $this->request('GET', '/v1/rdc/jobs/'.$this->segment($jobId)); }

    /**
     * Get a real device job asset.
     *
     * @return array<string, mixed>
     */
    public function getRdcJobAsset(string $jobId, string $assetType): array { return $this->request('GET', '/v1/rdc/jobs/'.$this->segment($jobId).'/'.$this->segment($assetType)); }

    /**
     * Stop one real device job.
     *
     * @return array<string, mixed>
     */
    public function stopRdcJob(string $jobId): array { return $this->request('PUT', '/v1/rdc/jobs/'.$this->segment($jobId).'/stop'); }

    /**
     * Delete one real device job.
     *
     * @return array<string, mixed>
     */
    public function deleteRdcJob(string $jobId): array { return $this->request('DELETE', '/v1/rdc/jobs/'.$this->segment($jobId)); }

    /**
     * List private real devices.
     *
     * @return array<string, mixed>
     */
    public function listPrivateDevices(): array { return $this->request('GET', '/v1/rdc/device-management/devices'); }

    /**
     * List Sauce Connect tunnels for a user.
     *
     * @return array<string, mixed>
     */
    public function listTunnels(string $username = ''): array { return $this->request('GET', $this->userPath($username).'/tunnels'); }

    /**
     * Get one Sauce Connect tunnel.
     *
     * @return array<string, mixed>
     */
    public function getTunnel(string $username, string $tunnelId): array { return $this->request('GET', $this->userPath($username).'/tunnels/'.$this->segment($tunnelId)); }

    /**
     * Get current running jobs for one tunnel.
     *
     * @return array<string, mixed>
     */
    public function getTunnelJobsCount(string $username, string $tunnelId): array { return $this->request('GET', $this->userPath($username).'/tunnels/'.$this->segment($tunnelId).'/num_jobs'); }

    /**
     * Stop one Sauce Connect tunnel.
     *
     * @return array<string, mixed>
     */
    public function stopTunnel(string $username, string $tunnelId): array { return $this->request('DELETE', $this->userPath($username).'/tunnels/'.$this->segment($tunnelId)); }

    /**
     * Execute a safe raw GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw PUT request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array { return $this->request('PUT', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch a Sauce Labs API request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Sauce Labs username and access key are required.');
        }

        $response = $this->rawRequest($method, $path, $data);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to Sauce Labs.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withBasicAuth($this->username, $this->accessKey)
            ->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported Sauce Labs method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Sauce Labs API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Sauce Labs API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Sauce Labs API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Sauce Labs API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Sauce Labs API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode a JSON or text Sauce Labs response.
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

    private function userPath(string $username = ''): string
    {
        return '/rest/v1/'.$this->segment($username !== '' ? $username : $this->username);
    }

    private function jobPath(string $username, string $jobId): string
    {
        return $this->userPath($username).'/jobs/'.$this->segment($jobId);
    }

    private function segment(string $value): string
    {
        return rawurlencode($value);
    }

    private function path(string $value): string
    {
        return implode('/', array_map('rawurlencode', explode('/', ltrim($value, '/'))));
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Sauce Labs API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
