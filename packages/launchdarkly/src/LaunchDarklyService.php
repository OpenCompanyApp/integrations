<?php

namespace OpenCompany\Integrations\LaunchDarkly;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LaunchDarklyService
{
    public function __construct(
        private string $accessToken = '',
        private string $projectKey = '',
        private string $baseUrl = 'https://app.launchdarkly.com/api/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->projectKey);
    }

    /**
     * Get the configured project key.
     */
    public function getProjectKey(): string
    {
        return $this->projectKey;
    }

    /**
     * List feature flags for a project (paginated).
     *
     * @param  string|null  $projectKey  Override the default project key
     * @param  int  $limit  Maximum number of flags to return (default: 20, max: 100)
     * @param  int  $offset  Offset for pagination (default: 0)
     * @return array<string, mixed>
     */
    public function listFlags(?string $projectKey = null, int $limit = 20, int $offset = 0, ?string $env = null): array
    {
        $project = $projectKey ?? $this->projectKey;

        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($env !== null) {
            $params['env'] = $env;
        }

        return $this->request('GET', "/flags/{$project}", $params);
    }

    /**
     * Get a single feature flag.
     *
     * @param  string  $featureFlagKey  The feature flag key
     * @param  string|null  $projectKey  Override the default project key
     * @param  string|null  $env  Environment key to filter by
     * @return array<string, mixed>
     */
    public function getFlag(string $featureFlagKey, ?string $projectKey = null, ?string $env = null): array
    {
        $project = $projectKey ?? $this->projectKey;

        $params = [];
        if ($env !== null) {
            $params['env'] = $env;
        }

        return $this->request('GET', "/flags/{$project}/{$featureFlagKey}", $params);
    }

    /**
     * Toggle a feature flag on or off for a specific environment.
     *
     * @param  string  $featureFlagKey  The feature flag key
     * @param  bool  $enabled  Whether to turn the flag on or off
     * @param  string  $environmentKey  The environment key (e.g., "production", "staging")
     * @param  string|null  $projectKey  Override the default project key
     * @return array<string, mixed>
     */
    public function toggleFlag(string $featureFlagKey, bool $enabled, string $environmentKey, ?string $projectKey = null): array
    {
        $project = $projectKey ?? $this->projectKey;

        $patch = [
            [
                'op' => 'replace',
                'path' => "/environments/{$environmentKey}/on",
                'value' => $enabled,
            ],
        ];

        return $this->request('PATCH', "/flags/{$project}/{$featureFlagKey}", $patch, true);
    }

    /**
     * List environments for a project.
     *
     * @param  string|null  $projectKey  Override the default project key
     * @return array<string, mixed>
     */
    public function listEnvironments(?string $projectKey = null): array
    {
        $project = $projectKey ?? $this->projectKey;

        return $this->request('GET', "/projects/{$project}/environments");
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
     * @param  string  $projectKey  The project key
     * @return array<string, mixed>
     */
    public function getProject(string $projectKey): array
    {
        return $this->request('GET', "/projects/{$projectKey}");
    }

    /**
     * Get the currently authenticated user.
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
     * @param  string  $method  HTTP method
     * @param  string  $path  API path (relative to base URL)
     * @param  array<int|string, mixed>  $data  Query params or request body
     * @param  bool  $isBody  If true, send $data as JSON body; otherwise as query params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $isBody = false): array
    {
        $response = $this->rawRequest($method, $path, $data, $isBody);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the LaunchDarkly API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<int|string, mixed>  $data  Request data
     * @param  bool  $isBody  Send as JSON body instead of query params
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $isBody = false): \Illuminate\Http\Client\Response
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
                'PATCH' => $http->withBody(json_encode($data), 'application/json')->patch($url),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("LaunchDarkly API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("LaunchDarkly API endpoint not available (HTTP {$response->status()}). Check your base URL and access token.");
                }

                $error = $response->json('message') ?? $response->body();
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
        }
    }
}
