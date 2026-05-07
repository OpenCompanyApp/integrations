<?php

namespace OpenCompany\Integrations\BrowserStack;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for BrowserStack Automate and App Automate APIs.
 *
 * Handles basic authentication, Automate and App Automate base URLs, JSON
 * response parsing, text log normalization, and API error handling.
 */
class BrowserStackService
{
    /**
     * @param  string  $username  BrowserStack username.
     * @param  string  $accessKey  BrowserStack access key.
     * @param  string  $baseUrl  BrowserStack Automate API base URL.
     * @param  string  $cloudBaseUrl  BrowserStack App Automate API base URL.
     */
    public function __construct(
        private string $username = '',
        private string $accessKey = '',
        private string $baseUrl = 'https://api.browserstack.com',
        private string $cloudBaseUrl = 'https://api-cloud.browserstack.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl ?: 'https://api.browserstack.com', '/');
        $this->cloudBaseUrl = rtrim($this->cloudBaseUrl ?: 'https://api-cloud.browserstack.com', '/');
    }

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return trim($this->username) !== '' && trim($this->accessKey) !== '';
    }

    /**
     * Get Automate plan details.
     *
     * @return array<string, mixed>
     */
    public function getPlan(): array { return $this->request('GET', '/automate/plan.json'); }

    /**
     * List available Automate browsers and devices.
     *
     * @param  array<string, mixed>  $query  Browser list filters.
     * @return array<string, mixed>
     */
    public function listBrowsers(array $query = []): array { return $this->request('GET', '/automate/browsers.json', $query); }

    /**
     * List Automate projects.
     *
     * @param  array<string, mixed>  $query  Pagination parameters.
     * @return array<string, mixed>
     */
    public function listProjects(array $query = []): array { return $this->request('GET', '/automate/projects.json', $query); }

    /**
     * Get one Automate project.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $projectId): array { return $this->request('GET', '/automate/projects/'.$this->segment($projectId).'.json'); }

    /**
     * Update an Automate project.
     *
     * @param  array<string, mixed>  $payload  Project update payload.
     * @return array<string, mixed>
     */
    public function updateProject(string $projectId, array $payload): array { return $this->request('PUT', '/automate/projects/'.$this->segment($projectId).'.json', $payload); }

    /**
     * Delete an Automate project.
     *
     * @return array<string, mixed>
     */
    public function deleteProject(string $projectId): array { return $this->request('DELETE', '/automate/projects/'.$this->segment($projectId).'.json'); }

    /**
     * List Automate builds.
     *
     * @param  array<string, mixed>  $query  Pagination and filter parameters.
     * @return array<string, mixed>
     */
    public function listBuilds(array $query = []): array { return $this->request('GET', '/automate/builds.json', $query); }

    /**
     * Update an Automate build name or tag.
     *
     * @param  array<string, mixed>  $payload  Build update payload.
     * @return array<string, mixed>
     */
    public function updateBuild(string $buildId, array $payload): array { return $this->request('PUT', '/automate/builds/'.$this->segment($buildId).'.json', $payload); }

    /**
     * Delete one Automate build.
     *
     * @return array<string, mixed>
     */
    public function deleteBuild(string $buildId): array { return $this->request('DELETE', '/automate/builds/'.$this->segment($buildId).'.json'); }

    /**
     * Delete multiple Automate builds.
     *
     * @param  array<string, mixed>  $query  buildId query values.
     * @return array<string, mixed>
     */
    public function deleteBuilds(array $query): array { return $this->request('DELETE', '/automate/builds', $query); }

    /**
     * List sessions for an Automate build.
     *
     * @param  array<string, mixed>  $query  Pagination parameters.
     * @return array<string, mixed>
     */
    public function listBuildSessions(string $buildId, array $query = []): array { return $this->request('GET', '/automate/builds/'.$this->segment($buildId).'/sessions.json', $query); }

    /**
     * Get one Automate session.
     *
     * @return array<string, mixed>
     */
    public function getSession(string $sessionId): array { return $this->request('GET', '/automate/sessions/'.$this->segment($sessionId).'.json'); }

    /**
     * Update one Automate session status or name.
     *
     * @param  array<string, mixed>  $payload  Session update payload.
     * @return array<string, mixed>
     */
    public function updateSession(string $sessionId, array $payload): array { return $this->request('PUT', '/automate/sessions/'.$this->segment($sessionId).'.json', $payload); }

    /**
     * Delete one Automate session.
     *
     * @return array<string, mixed>
     */
    public function deleteSession(string $sessionId): array { return $this->request('DELETE', '/automate/sessions/'.$this->segment($sessionId).'.json'); }

    /**
     * Get text logs for an Automate session.
     *
     * @return array<string, mixed>
     */
    public function getSessionLogs(string $sessionId): array { return $this->request('GET', '/automate/sessions/'.$this->segment($sessionId).'/logs'); }

    /**
     * Get HAR network logs for an Automate session.
     *
     * @return array<string, mixed>
     */
    public function getSessionNetworkLogs(string $sessionId): array { return $this->request('GET', '/automate/sessions/'.$this->segment($sessionId).'/networklogs'); }

    /**
     * Upload an App Automate app using a public URL and metadata.
     *
     * @param  array<string, mixed>  $payload  Upload payload containing url and optional custom_id.
     * @return array<string, mixed>
     */
    public function uploadApp(array $payload): array { return $this->request('POST', '/app-automate/upload', $payload, true); }

    /**
     * List recently uploaded App Automate apps.
     *
     * @return array<string, mixed>
     */
    public function listRecentApps(?string $customId = null): array
    {
        $path = '/app-automate/recent_apps'.($customId !== null && $customId !== '' ? '/'.$this->segment($customId) : '');

        return $this->request('GET', $path, [], true);
    }

    /**
     * Delete an uploaded App Automate app.
     *
     * @return array<string, mixed>
     */
    public function deleteApp(string $appId): array { return $this->request('DELETE', '/app-automate/app/delete/'.$this->segment($appId), [], true); }

    /**
     * Execute a safe raw Automate API GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $this->normalizePath($path), $query); }

    /**
     * Execute a safe raw Automate API POST request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array { return $this->request('POST', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw Automate API PUT request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array { return $this->request('PUT', $this->normalizePath($path), $payload); }

    /**
     * Execute a safe raw Automate API DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $this->normalizePath($path), $query); }

    /**
     * Dispatch a BrowserStack API request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $cloud = false): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('BrowserStack username and access key are required.');
        }

        $response = $this->rawRequest($method, $path, $data, $cloud);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to BrowserStack.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $cloud = false): Response
    {
        $url = ($cloud ? $this->cloudBaseUrl : $this->baseUrl).$path;
        $http = Http::withBasicAuth($this->username, $this->accessKey)
            ->withHeaders(['Accept' => 'application/json', 'Content-Type' => 'application/json'])
            ->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported BrowserStack method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("BrowserStack API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to BrowserStack API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized BrowserStack API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json) ? (string) ($json['message'] ?? $json['error'] ?? '') : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("BrowserStack API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('BrowserStack API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode a JSON or text BrowserStack response.
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

    private function segment(string $value): string
    {
        return rawurlencode($value);
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('BrowserStack API path must be a non-empty relative path.');
        }

        return '/'.ltrim($path, '/');
    }
}
