<?php

namespace OpenCompany\Integrations\CircleCI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CircleCIService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://circleci.com/api',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the current authenticated user.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/v2/user');
    }

    /**
     * List pipelines for an organization.
     *
     * @param  array<string, mixed>  $params  Query parameters (orgSlug, branch, limit, page)
     */
    public function listPipelines(array $params = []): array
    {
        return $this->request('GET', '/v2/pipeline', $params);
    }

    /**
     * Get details for a specific pipeline.
     */
    public function getPipeline(string $id): array
    {
        return $this->request('GET', '/v2/pipeline/' . urlencode($id));
    }

    /**
     * List workflows for a specific pipeline.
     */
    public function listWorkflows(string $pipelineId): array
    {
        return $this->request('GET', '/v2/pipeline/' . urlencode($pipelineId) . '/workflow');
    }

    /**
     * Get details for a specific workflow.
     */
    public function getWorkflow(string $id): array
    {
        return $this->request('GET', '/v2/workflow/' . urlencode($id));
    }

    /**
     * List projects for an organization.
     *
     * @param  array<string, mixed>  $params  Query parameters (orgSlug, limit)
     */
    public function listProjects(array $params = []): array
    {
        return $this->request('GET', '/v2/projects', $params);
    }

    /**
     * Trigger a new pipeline for a project.
     *
     * @param  string  $orgSlug      Organization slug (e.g., "gh/my-org")
     * @param  string  $projectSlug  Project slug (e.g., "my-repo")
     * @param  array<string, mixed>  $body  Request body (branch, parameters)
     */
    public function triggerPipeline(string $orgSlug, string $projectSlug, array $body = []): array
    {
        return $this->request(
            'POST',
            '/v2/project/' . urlencode($orgSlug) . '/' . urlencode($projectSlug) . '/pipeline',
            $body,
        );
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API path (e.g., "/v2/pipeline")
     * @param  array<string, mixed>  $data  Query parameters or request body
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the CircleCI API.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path    API path (e.g., "/v2/pipeline")
     * @param  array<string, mixed>  $data  Query parameters or request body
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('CircleCI access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Circle-Token' => $this->accessToken,
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
                    Log::warning("CircleCI API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("CircleCI API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is unavailable.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("CircleCI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("CircleCI API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("CircleCI API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to CircleCI API: {$e->getMessage()}");
        }
    }
}
