<?php

namespace OpenCompany\Integrations\Bugsnag;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Bugsnag APIs.
 *
 * Handles Data Access API v2 authentication headers, request dispatch, error
 * logging, and JSON response parsing for Bugsnag tool classes.
 */
class BugsnagService
{
    /**
     * @param  string  $apiToken  Bugsnag personal API token.
     * @param  string  $baseUrl  Bugsnag Data Access API base URL.
     * @param  string  $notifyUrl  Bugsnag Error Reporting API base URL.
     * @param  string  $buildUrl  Bugsnag Build API base URL.
     * @param  string  $sessionsUrl  Bugsnag Session Tracking API base URL.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.bugsnag.com',
        private string $notifyUrl = 'https://notify.bugsnag.com',
        private string $buildUrl = 'https://build.bugsnag.com',
        private string $sessionsUrl = 'https://sessions.bugsnag.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->notifyUrl = rtrim($this->notifyUrl, '/');
        $this->buildUrl = rtrim($this->buildUrl, '/');
        $this->sessionsUrl = rtrim($this->sessionsUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiToken !== '';
    }

    /**
     * List projects visible to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->apiGet('/projects', $params);
    }

    /**
     * Get details for a single project.
     *
     * @return array<string, mixed>
     */
    public function getProject(string $id): array
    {
        return $this->apiGet('/projects/' . rawurlencode($id));
    }

    /**
     * List errors for a project.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listErrors(string $projectId, array $params = []): array
    {
        return $this->apiGet('/projects/' . rawurlencode($projectId) . '/errors', $params);
    }

    /**
     * Get details for a single error.
     *
     * @return array<string, mixed>
     */
    public function getError(string $id): array
    {
        return $this->apiGet('/errors/' . rawurlencode($id));
    }

    /**
     * List events for a project.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listEvents(string $projectId, array $params = []): array
    {
        return $this->apiGet('/projects/' . rawurlencode($projectId) . '/events', $params);
    }

    /**
     * List collaborators for an organization.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCollaborators(string $orgId, array $params = []): array
    {
        return $this->apiGet('/organizations/' . rawurlencode($orgId) . '/collaborators', $params);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/user');
    }

    /**
     * Send a Data Access API GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->baseUrl, $path, $query);
    }

    /**
     * Send a Data Access API POST request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $data = [], array $query = []): array
    {
        return $this->request('POST', $this->baseUrl, $path, $data, $query);
    }

    /**
     * Send a Data Access API PATCH request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PATCH', $this->baseUrl, $path, $data, $query);
    }

    /**
     * Send a Data Access API DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $this->baseUrl, $path, $query);
    }

    /**
     * Send an Error Reporting API request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @return array<string, mixed>
     */
    public function notifyPost(string $path, array $data = []): array
    {
        return $this->request('POST', $this->notifyUrl, $path, $data, [], false);
    }

    /**
     * Send a Build API request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @return array<string, mixed>
     */
    public function buildPost(string $path, array $data = []): array
    {
        return $this->request('POST', $this->buildUrl, $path, $data, [], false);
    }

    /**
     * Send a Session Tracking API request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @return array<string, mixed>
     */
    public function sessionsPost(string $path, array $data = []): array
    {
        return $this->request('POST', $this->sessionsUrl, $path, $data, [], false);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params for GET/DELETE or body for mutating requests.
     * @param  array<string, mixed>  $query  Query params for mutating requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $baseUrl, string $path, array $data = [], array $query = [], bool $versioned = true): array
    {
        $response = $this->rawRequest($method, $baseUrl, $path, $data, $query, $versioned);

        if ($response->status() === 204 || trim($response->body()) === '') {
            return [];
        }

        return $response->json() ?? ['body' => $response->body()];
    }

    /**
     * Make a raw HTTP request to Bugsnag.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     */
    private function rawRequest(string $method, string $baseUrl, string $path, array $data = [], array $query = [], bool $versioned = true): Response
    {
        if ($this->apiToken === '') {
            throw new RuntimeException('Bugsnag API token is not configured.');
        }

        $url = $baseUrl . '/' . ltrim($path, '/');
        $headers = [
            'Authorization' => 'token ' . $this->apiToken,
        ];

        if ($versioned) {
            $headers['X-Version'] = '2';
        }

        try {
            $http = Http::withHeaders($headers)
                ->acceptJson()
                ->asJson()
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->withOptions(['query' => $query])->post($url, $data),
                'PATCH' => $http->withOptions(['query' => $query])->patch($url, $data),
                'DELETE' => $http->withOptions(['query' => $data])->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();

                Log::error("Bugsnag API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('Bugsnag API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("Bugsnag API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Bugsnag API: {$e->getMessage()}");
        }
    }
}
