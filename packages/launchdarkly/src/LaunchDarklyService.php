<?php

namespace OpenCompany\Integrations\LaunchDarkly;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the LaunchDarkly REST API.
 *
 * Handles API token authentication, path normalization, JSON request dispatch,
 * and focused helpers used by LaunchDarkly tools.
 */
class LaunchDarklyService
{
    /**
     * @param  string  $accessToken  LaunchDarkly API access token.
     * @param  string  $projectKey  Default LaunchDarkly project key.
     * @param  string  $baseUrl  LaunchDarkly REST API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $projectKey = '',
        private string $baseUrl = 'https://app.launchdarkly.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Get the configured project key.
     */
    public function getProjectKey(): string
    {
        return $this->projectKey;
    }

    /**
     * Execute a raw GET request against the LaunchDarkly API.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Execute a raw POST request against the LaunchDarkly API.
     *
     * @param  array<int|string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw PATCH request against the LaunchDarkly API.
     *
     * @param  array<int|string, mixed>  $payload  JSON Patch, merge patch, or semantic patch body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw PUT request against the LaunchDarkly API.
     *
     * @param  array<int|string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a raw DELETE request against the LaunchDarkly API.
     *
     * @param  array<int|string, mixed>  $payload  Optional JSON request body.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * List feature flags for a project.
     *
     * @param  string|null  $projectKey  Override the default project key.
     * @param  int  $limit  Maximum number of flags to return.
     * @param  int  $offset  Offset for pagination.
     * @param  string|null  $env  Environment key filter.
     * @return array<string, mixed>
     */
    public function listFlags(?string $projectKey = null, int $limit = 20, int $offset = 0, ?string $env = null): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($env !== null) {
            $params['env'] = $env;
        }

        return $this->request('GET', '/flags/' . rawurlencode($this->resolveProject($projectKey)), $params);
    }

    /**
     * Get a single feature flag.
     *
     * @param  string  $featureFlagKey  The feature flag key.
     * @param  string|null  $projectKey  Override the default project key.
     * @param  string|null  $env  Environment key to filter by.
     * @return array<string, mixed>
     */
    public function getFlag(string $featureFlagKey, ?string $projectKey = null, ?string $env = null): array
    {
        $params = [];
        if ($env !== null) {
            $params['env'] = $env;
        }

        return $this->request(
            'GET',
            '/flags/' . rawurlencode($this->resolveProject($projectKey)) . '/' . rawurlencode($featureFlagKey),
            $params,
        );
    }

    /**
     * Toggle a feature flag on or off for a specific environment.
     *
     * @param  string  $featureFlagKey  The feature flag key.
     * @param  bool  $enabled  Whether to turn the flag on or off.
     * @param  string  $environmentKey  The environment key.
     * @param  string|null  $projectKey  Override the default project key.
     * @return array<string, mixed>
     */
    public function toggleFlag(string $featureFlagKey, bool $enabled, string $environmentKey, ?string $projectKey = null): array
    {
        $patch = [
            [
                'op' => 'replace',
                'path' => "/environments/{$environmentKey}/on",
                'value' => $enabled,
            ],
        ];

        return $this->request(
            'PATCH',
            '/flags/' . rawurlencode($this->resolveProject($projectKey)) . '/' . rawurlencode($featureFlagKey),
            $patch,
        );
    }

    /**
     * List environments for a project.
     *
     * @param  string|null  $projectKey  Override the default project key.
     * @return array<string, mixed>
     */
    public function listEnvironments(?string $projectKey = null): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($this->resolveProject($projectKey)) . '/environments');
    }

    /**
     * List all projects.
     *
     * @return array<string, mixed>
     */
    public function listProjects(): array
    {
        return $this->request('GET', '/projects');
    }

    /**
     * Get a single project by key.
     *
     * @param  string  $projectKey  The project key.
     * @return array<string, mixed>
     */
    public function getProject(string $projectKey): array
    {
        return $this->request('GET', '/projects/' . rawurlencode($projectKey));
    }

    /**
     * Get the currently authenticated member.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/members/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<int|string, mixed>  $data  Request data.
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
     * Resolve an explicit or configured project key.
     */
    private function resolveProject(?string $projectKey = null): string
    {
        $project = $projectKey ?: $this->projectKey;

        if ($project === '') {
            throw new \RuntimeException('LaunchDarkly project key is required for this operation.');
        }

        return $project;
    }

    /**
     * Normalize a user-supplied API path to a relative LaunchDarkly v2 path.
     */
    private function normalizePath(string $path): string
    {
        $path = trim($path);

        if ($path === '') {
            throw new \RuntimeException('LaunchDarkly API path is required.');
        }

        if (str_starts_with($path, $this->baseUrl)) {
            $path = substr($path, strlen($this->baseUrl));
        }

        if (str_starts_with($path, '/api/v2/')) {
            $path = substr($path, strlen('/api/v2'));
        }

        return '/' . ltrim($path, '/');
    }

    /**
     * Make a raw HTTP request to the LaunchDarkly API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<int|string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('LaunchDarkly access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->withBody(json_encode($data, JSON_THROW_ON_ERROR), 'application/json')->patch($url),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type') ?? '';
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("LaunchDarkly API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("LaunchDarkly API endpoint not available (HTTP {$response->status()}). Check your base URL and access token.");
                }

                $json = $response->json();
                $error = is_array($json) ? ($json['message'] ?? $json['error'] ?? $body) : $body;

                Log::error("LaunchDarkly API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("LaunchDarkly API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("LaunchDarkly API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to LaunchDarkly API: {$e->getMessage()}");
        } catch (\JsonException $e) {
            throw new \RuntimeException("Failed to encode LaunchDarkly API payload: {$e->getMessage()}");
        }
    }
}
