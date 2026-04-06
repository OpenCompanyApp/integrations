<?php

namespace OpenCompany\Integrations\Bugsnag;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BugsnagService
{
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.bugsnag.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    /**
     * List projects visible to the authenticated user.
     *
     * @param  int  $limit   Maximum number of projects to return.
     * @param  int  $offset  Number of projects to skip (for pagination).
     * @param  string|null  $q  Search query to filter projects by name.
     * @return array<string, mixed>
     */
    public function listProjects(int $limit = 30, int $offset = 0, ?string $q = null): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($q !== null) {
            $params['q'] = $q;
        }

        return $this->request('GET', '/projects', $params);
    }

    /**
     * Get details for a single project.
     *
     * @param  string  $id  The project ID.
     * @return array<string, mixed>
     */
    public function getProject(string $id): array
    {
        return $this->request('GET', '/projects/' . urlencode($id));
    }

    /**
     * List errors for a project.
     *
     * @param  string  $projectId  The project ID.
     * @param  int  $limit  Maximum number of errors to return.
     * @param  int  $offset  Number of errors to skip.
     * @param  string|null  $severity  Filter by severity (error, warning, info).
     * @param  string|null  $status  Filter by status (open, fixed, snoozed).
     * @param  string|null  $sort  Sort order (created_at, updated_at, unhandled_occurrence_count).
     * @return array<string, mixed>
     */
    public function listErrors(
        string $projectId,
        int $limit = 30,
        int $offset = 0,
        ?string $severity = null,
        ?string $status = null,
        ?string $sort = null,
    ): array {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($severity !== null) {
            $params['severity'] = $severity;
        }

        if ($status !== null) {
            $params['status'] = $status;
        }

        if ($sort !== null) {
            $params['sort'] = $sort;
        }

        return $this->request('GET', '/projects/' . urlencode($projectId) . '/errors', $params);
    }

    /**
     * Get details for a single error.
     *
     * @param  string  $id  The error ID.
     * @return array<string, mixed>
     */
    public function getError(string $id): array
    {
        return $this->request('GET', '/errors/' . urlencode($id));
    }

    /**
     * List events for a project.
     *
     * @param  string  $projectId  The project ID.
     * @param  int  $limit  Maximum number of events to return.
     * @param  int  $offset  Number of events to skip.
     * @param  string|null  $errorId  Filter events by error ID.
     * @return array<string, mixed>
     */
    public function listEvents(
        string $projectId,
        int $limit = 30,
        int $offset = 0,
        ?string $errorId = null,
    ): array {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($errorId !== null) {
            $params['error_id'] = $errorId;
        }

        return $this->request('GET', '/projects/' . urlencode($projectId) . '/events', $params);
    }

    /**
     * List collaborators for an organization.
     *
     * @param  string  $orgId  The organization ID.
     * @param  int  $limit  Maximum number of collaborators to return.
     * @param  int  $offset  Number of collaborators to skip.
     * @return array<string, mixed>
     */
    public function listCollaborators(string $orgId, int $limit = 30, int $offset = 0): array
    {
        return $this->request('GET', '/organizations/' . urlencode($orgId) . '/collaborators', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Bugsnag API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('Bugsnag API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'token ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Bugsnag API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Bugsnag API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Bugsnag API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Bugsnag API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Bugsnag API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Bugsnag API: {$e->getMessage()}");
        }
    }
}
