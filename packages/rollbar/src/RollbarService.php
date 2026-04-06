<?php

namespace OpenCompany\Integrations\Rollbar;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the Rollbar API.
 *
 * Handles authentication via Bearer token and provides methods
 * for all supported Rollbar API endpoints.
 *
 * @see https://docs.rollbar.com/docs/api
 */
class RollbarService
{
    /**
     * Create a new RollbarService instance.
     *
     * @param  string  $accessToken  Rollbar account-level access token
     * @param  string  $baseUrl      Rollbar API base URL
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.rollbar.com/api/1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List all projects in the Rollbar account.
     *
     * @param  int  $limit   Maximum number of projects to return (default: 20)
     * @param  int  $offset  Offset for pagination (default: 0)
     * @return array<string, mixed>
     *
     * @see https://docs.rollbar.com/docs/list-all-projects
     */
    public function listProjects(int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/projects', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a single project by its ID.
     *
     * @param  int  $id  The project ID
     * @return array<string, mixed>
     *
     * @see https://docs.rollbar.com/docs/project
     */
    public function getProject(int $id): array
    {
        return $this->request('GET', '/project/' . $id);
    }

    /**
     * List items (errors) across projects or within a specific project.
     *
     * @param  int|null  $projectId    Optional project ID to filter by
     * @param  int       $limit        Maximum number of items to return (default: 20)
     * @param  int       $offset       Offset for pagination (default: 0)
     * @param  string|null  $level     Filter by level: debug, info, warning, error, critical
     * @param  string|null  $status    Filter by status: active, resolved, muted
     * @param  string|null  $environment Filter by environment name
     * @return array<string, mixed>
     *
     * @see https://docs.rollbar.com/docs/list-all-items
     */
    public function listItems(
        ?int $projectId = null,
        int $limit = 20,
        int $offset = 0,
        ?string $level = null,
        ?string $status = null,
        ?string $environment = null,
    ): array {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($projectId !== null) {
            $params['projectId'] = $projectId;
        }

        if ($level !== null) {
            $params['level'] = $level;
        }

        if ($status !== null) {
            $params['status'] = $status;
        }

        if ($environment !== null) {
            $params['environment'] = $environment;
        }

        return $this->request('GET', '/items', $params);
    }

    /**
     * Get a single item (error) by its ID.
     *
     * The Rollbar API requires the access_token to be passed as a query parameter
     * for this endpoint rather than as a Bearer header.
     *
     * @param  int  $id  The item ID
     * @return array<string, mixed>
     *
     * @see https://docs.rollbar.com/docs/item
     */
    public function getItem(int $id): array
    {
        return $this->request('GET', '/item/' . $id, [
            'access_token' => $this->accessToken,
        ], useBearer: false);
    }

    /**
     * List deploys across the account.
     *
     * @param  string|null  $environment  Optional environment filter
     * @param  int          $limit        Maximum number of deploys to return (default: 20)
     * @param  int          $page         Page number for pagination (default: 1)
     * @return array<string, mixed>
     *
     * @see https://docs.rollbar.com/docs/list-all-deploys
     */
    public function listDeploys(
        ?string $environment = null,
        int $limit = 20,
        int $page = 1,
    ): array {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($environment !== null) {
            $params['environment'] = $environment;
        }

        return $this->request('GET', '/deploys', $params);
    }

    /**
     * List all teams in the Rollbar account.
     *
     * @param  int  $limit   Maximum number of teams to return (default: 20)
     * @param  int  $offset  Offset for pagination (default: 0)
     * @return array<string, mixed>
     *
     * @see https://docs.rollbar.com/docs/list-all-teams
     */
    public function listTeams(int $limit = 20, int $offset = 0): array
    {
        return $this->request('GET', '/teams', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     *
     * @see https://docs.rollbar.com/docs/user
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method     HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path       API endpoint path
     * @param  array   $data       Query parameters or request body
     * @param  bool    $useBearer  Whether to send the token as a Bearer header (default: true)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $useBearer = true): array
    {
        $response = $this->rawRequest($method, $path, $data, $useBearer);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Rollbar API.
     *
     * @param  string  $method     HTTP method
     * @param  string  $path       API endpoint path
     * @param  array   $data       Query parameters or request body
     * @param  bool    $useBearer  Whether to send the token as a Bearer header
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException If the access token is not configured
     * @throws \RuntimeException If the API returns an error response
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $useBearer = true): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Rollbar access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::timeout(30);

            if ($useBearer) {
                $http = $http->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Content-Type' => 'application/json',
                ]);
            }

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
                    Log::warning("Rollbar API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Rollbar API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may not be accessible with the current token.");
                }

                $error = $response->json('message') ?? $response->json('err') ?? $body;
                Log::error("Rollbar API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Rollbar API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Rollbar API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Rollbar API: {$e->getMessage()}");
        }
    }
}
