<?php

namespace OpenCompany\Integrations\N8n;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the n8n REST API.
 *
 * Provides methods for workflows, executions, credentials, and user management.
 */
class N8nService
{
    private const BASE_URL = 'https://api.n8n.io/v1';

    /**
     * @param  string  $apiKey  n8n API key
     */
    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the n8n API key has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /*-----------------------------------------------------------------------
     | Workflows
     *---------------------------------------------------------------------*/

    /**
     * List workflows.
     *
     * @param  array<string, mixed>  $params  Query parameters (cursor, limit)
     * @return array<string, mixed>
     */
    public function listWorkflows(array $params = []): array
    {
        return $this->request('GET', '/workflows', $params);
    }

    /**
     * Get details for a specific workflow.
     *
     * @return array<string, mixed>
     */
    public function getWorkflow(string $workflowId): array
    {
        return $this->request('GET', "/workflows/{$workflowId}");
    }

    /**
     * Create a new workflow.
     *
     * @param  array<string, mixed>  $params  Workflow properties (name, nodes, connections, settings)
     * @return array<string, mixed>
     */
    public function createWorkflow(array $params): array
    {
        return $this->request('POST', '/workflows', $params);
    }

    /*-----------------------------------------------------------------------
     | Executions
     *---------------------------------------------------------------------*/

    /**
     * List executions.
     *
     * @param  array<string, mixed>  $params  Query parameters (cursor, limit, status, workflowId)
     * @return array<string, mixed>
     */
    public function listExecutions(array $params = []): array
    {
        return $this->request('GET', '/executions', $params);
    }

    /**
     * Get details for a specific execution.
     *
     * @return array<string, mixed>
     */
    public function getExecution(string $executionId): array
    {
        return $this->request('GET', "/executions/{$executionId}");
    }

    /*-----------------------------------------------------------------------
     | Credentials
     *---------------------------------------------------------------------*/

    /**
     * List credentials.
     *
     * @param  array<string, mixed>  $params  Query parameters (cursor, limit)
     * @return array<string, mixed>
     */
    public function listCredentials(array $params = []): array
    {
        return $this->request('GET', '/credentials', $params);
    }

    /*-----------------------------------------------------------------------
     | User
     *---------------------------------------------------------------------*/

    /**
     * Get the current authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    /**
     * Make an authenticated API request to n8n.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->apiKey) {
            throw new \RuntimeException('n8n API key is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->apiKey}",
                'Accept' => 'application/json',
            ])->timeout(30);

            $url = self::BASE_URL . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'PATCH' => $http->patch($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 429) {
                $msg = 'n8n rate limit exceeded. Please retry after a moment.';
                throw new \RuntimeException($msg);
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['message'] ?? $response->body();

                Log::error("n8n API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'n8n API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("n8n API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to n8n API: {$e->getMessage()}");
        }
    }
}
