<?php

namespace OpenCompany\Integrations\TeamCity;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the TeamCity REST API.
 *
 * Handles bearer token authentication, JSON request/response headers, locator
 * path encoding, response parsing, and normalized error messages.
 */
class TeamCityService
{
    /**
     * @param  string  $accessToken  TeamCity access token.
     * @param  string  $baseUrl  TeamCity server URL or `/app/rest` API URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = $this->normalizeBaseUrl($this->baseUrl);
    }

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return trim($this->accessToken) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Get TeamCity server details.
     *
     * @return array<string, mixed>
     */
    public function getServerInfo(): array
    {
        return $this->request('GET', '/server');
    }

    /**
     * List projects.
     *
     * @param  array<string, mixed>  $query  Query parameters such as locator and fields.
     * @return array<string, mixed>
     */
    public function listProjects(array $query = []): array
    {
        return $this->request('GET', '/projects', $query);
    }

    /**
     * Get one project by locator.
     *
     * @param  array<string, mixed>  $query  Optional fields query.
     * @return array<string, mixed>
     */
    public function getProject(string $locator, array $query = []): array
    {
        return $this->request('GET', '/projects/'.$this->segment($locator), $query);
    }

    /**
     * Create a project.
     *
     * @param  array<string, mixed>  $payload  Project entity payload.
     * @return array<string, mixed>
     */
    public function createProject(array $payload): array
    {
        return $this->request('POST', '/projects', $payload);
    }

    /**
     * Delete one project by locator.
     *
     * @return array<string, mixed>
     */
    public function deleteProject(string $locator): array
    {
        return $this->request('DELETE', '/projects/'.$this->segment($locator));
    }

    /**
     * List build configurations.
     *
     * @param  array<string, mixed>  $query  Query parameters such as locator and fields.
     * @return array<string, mixed>
     */
    public function listBuildTypes(array $query = []): array
    {
        return $this->request('GET', '/buildTypes', $query);
    }

    /**
     * Get one build configuration by locator.
     *
     * @param  array<string, mixed>  $query  Optional fields query.
     * @return array<string, mixed>
     */
    public function getBuildType(string $locator, array $query = []): array
    {
        return $this->request('GET', '/buildTypes/'.$this->segment($locator), $query);
    }

    /**
     * List builds for one build configuration.
     *
     * @param  array<string, mixed>  $query  Build locator and fields query.
     * @return array<string, mixed>
     */
    public function listBuildTypeBuilds(string $locator, array $query = []): array
    {
        return $this->request('GET', '/buildTypes/'.$this->segment($locator).'/builds', $query);
    }

    /**
     * List builds by TeamCity build locator.
     *
     * @param  array<string, mixed>  $query  Build locator and fields query.
     * @return array<string, mixed>
     */
    public function listBuilds(array $query = []): array
    {
        return $this->request('GET', '/builds', $query);
    }

    /**
     * Get one build by locator.
     *
     * @param  array<string, mixed>  $query  Optional fields query.
     * @return array<string, mixed>
     */
    public function getBuild(string $locator, array $query = []): array
    {
        return $this->request('GET', '/builds/'.$this->segment($locator), $query);
    }

    /**
     * Add a build to the queue.
     *
     * @param  array<string, mixed>  $payload  TeamCity Build entity payload.
     * @return array<string, mixed>
     */
    public function queueBuild(array $payload): array
    {
        return $this->request('POST', '/buildQueue', $payload);
    }

    /**
     * Cancel a queued build by locator.
     *
     * @param  array<string, mixed>  $payload  BuildCancelRequest payload.
     * @return array<string, mixed>
     */
    public function cancelQueuedBuild(string $locator, array $payload = []): array
    {
        return $this->request('DELETE_JSON', '/buildQueue/'.$this->segment($locator), $this->cancelPayload($payload));
    }

    /**
     * Cancel a started build by locator.
     *
     * @param  array<string, mixed>  $payload  BuildCancelRequest payload.
     * @return array<string, mixed>
     */
    public function cancelBuild(string $locator, array $payload = []): array
    {
        return $this->request('DELETE_JSON', '/builds/'.$this->segment($locator), $this->cancelPayload($payload));
    }

    /**
     * Delete build metadata by locator.
     *
     * @return array<string, mixed>
     */
    public function deleteBuild(string $locator): array
    {
        return $this->request('DELETE', '/builds/'.$this->segment($locator));
    }

    /**
     * List build artifact files.
     *
     * @param  array<string, mixed>  $query  Artifact listing query.
     * @return array<string, mixed>
     */
    public function listBuildArtifacts(string $locator, string $path = '/', array $query = []): array
    {
        return $this->request('GET', '/builds/'.$this->segment($locator).'/artifacts/'.$this->artifactPath($path), $query);
    }

    /**
     * Get build statistics.
     *
     * @param  array<string, mixed>  $query  Optional fields query.
     * @return array<string, mixed>
     */
    public function getBuildStatistics(string $locator, array $query = []): array
    {
        return $this->request('GET', '/builds/'.$this->segment($locator).'/statistics', $query);
    }

    /**
     * Get build tags.
     *
     * @param  array<string, mixed>  $query  Optional locator and fields query.
     * @return array<string, mixed>
     */
    public function getBuildTags(string $locator, array $query = []): array
    {
        return $this->request('GET', '/builds/'.$this->segment($locator).'/tags', $query);
    }

    /**
     * Add build tags.
     *
     * @param  array<string, mixed>  $payload  Tags entity payload.
     * @return array<string, mixed>
     */
    public function addBuildTags(string $locator, array $payload): array
    {
        return $this->request('POST', '/builds/'.$this->segment($locator).'/tags', $payload);
    }

    /**
     * Update build pin info.
     *
     * @param  array<string, mixed>  $payload  PinInfo entity payload.
     * @return array<string, mixed>
     */
    public function setBuildPinInfo(string $locator, array $payload): array
    {
        return $this->request('PUT', '/builds/'.$this->segment($locator).'/pinInfo', $payload);
    }

    /**
     * List queued builds.
     *
     * @param  array<string, mixed>  $query  Queue locator and fields query.
     * @return array<string, mixed>
     */
    public function listBuildQueue(array $query = []): array
    {
        return $this->request('GET', '/buildQueue', $query);
    }

    /**
     * Update global build queue paused state.
     *
     * @param  array<string, mixed>  $payload  Paused state payload.
     * @return array<string, mixed>
     */
    public function setQueuePaused(array $payload): array
    {
        return $this->request('PUT', '/buildQueue/pausedState', $payload);
    }

    /**
     * List agents.
     *
     * @param  array<string, mixed>  $query  Agent locator and fields query.
     * @return array<string, mixed>
     */
    public function listAgents(array $query = []): array
    {
        return $this->request('GET', '/agents', $query);
    }

    /**
     * Get one agent by locator.
     *
     * @param  array<string, mixed>  $query  Optional fields query.
     * @return array<string, mixed>
     */
    public function getAgent(string $locator, array $query = []): array
    {
        return $this->request('GET', '/agents/'.$this->segment($locator), $query);
    }

    /**
     * List users.
     *
     * @param  array<string, mixed>  $query  User locator and fields query.
     * @return array<string, mixed>
     */
    public function listUsers(array $query = []): array
    {
        return $this->request('GET', '/users', $query);
    }

    /**
     * Get one user by locator.
     *
     * @param  array<string, mixed>  $query  Optional fields query.
     * @return array<string, mixed>
     */
    public function getUser(string $locator, array $query = []): array
    {
        return $this->request('GET', '/users/'.$this->segment($locator), $query);
    }

    /**
     * List groups.
     *
     * @param  array<string, mixed>  $query  Group locator and fields query.
     * @return array<string, mixed>
     */
    public function listGroups(array $query = []): array
    {
        return $this->request('GET', '/userGroups', $query);
    }

    /**
     * List investigations.
     *
     * @param  array<string, mixed>  $query  Investigation locator and fields query.
     * @return array<string, mixed>
     */
    public function listInvestigations(array $query = []): array
    {
        return $this->request('GET', '/investigations', $query);
    }

    /**
     * List problems.
     *
     * @param  array<string, mixed>  $query  Problem locator and fields query.
     * @return array<string, mixed>
     */
    public function listProblems(array $query = []): array
    {
        return $this->request('GET', '/problems', $query);
    }

    /**
     * List changes.
     *
     * @param  array<string, mixed>  $query  Change locator and fields query.
     * @return array<string, mixed>
     */
    public function listChanges(array $query = []): array
    {
        return $this->request('GET', '/changes', $query);
    }

    /**
     * List VCS roots.
     *
     * @param  array<string, mixed>  $query  VCS root locator and fields query.
     * @return array<string, mixed>
     */
    public function listVcsRoots(array $query = []): array
    {
        return $this->request('GET', '/vcs-roots', $query);
    }

    /**
     * Execute a safe relative GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Execute a safe relative POST request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a safe relative PUT request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a safe relative PATCH request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a safe relative DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $query);
    }

    /**
     * Dispatch a TeamCity API request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('TeamCity URL and access token are required.');
        }

        $response = $this->rawRequest($method, $path, $data);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to TeamCity.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->accessToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(30);

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                'DELETE_JSON' => $http->send('DELETE', $url, ['json' => $data]),
                default => throw new RuntimeException("Unsupported TeamCity method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("TeamCity API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to TeamCity API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized TeamCity API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) ($json['message'] ?? $json['error'] ?? $json['errorMessage'] ?? '')
            : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("TeamCity API error: {$method} {$path}", [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        throw new RuntimeException('TeamCity API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode a JSON or text TeamCity response.
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

    /**
     * Build a safe default cancel payload.
     *
     * @param  array<string, mixed>  $payload  User supplied cancel payload.
     * @return array<string, mixed>
     */
    private function cancelPayload(array $payload): array
    {
        return $payload === [] ? ['comment' => 'Canceled by integration tool.', 'readdIntoQueue' => false] : $payload;
    }

    private function normalizeBaseUrl(string $url): string
    {
        $url = rtrim(trim($url), '/');
        if ($url === '') {
            return '';
        }

        if (!str_ends_with($url, '/app/rest')) {
            $url .= '/app/rest';
        }

        return $url;
    }

    private function segment(string $value): string
    {
        return strtr(rawurlencode($value), [
            '%3A' => ':',
            '%2C' => ',',
            '%28' => '(',
            '%29' => ')',
        ]);
    }

    private function artifactPath(string $path): string
    {
        $path = trim($path, '/');

        return $path === '' ? '' : str_replace('%2F', '/', rawurlencode($path));
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('TeamCity API path must be a non-empty relative path.');
        }

        if (str_starts_with($path, '/app/rest/')) {
            $path = substr($path, strlen('/app/rest'));
        }

        return '/'.ltrim($path, '/');
    }
}
