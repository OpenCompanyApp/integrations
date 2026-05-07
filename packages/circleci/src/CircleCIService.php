<?php

namespace OpenCompany\Integrations\CircleCI;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the CircleCI API v2.
 *
 * Handles Circle-Token authentication, request dispatch, error logging, and
 * response parsing for all CircleCI tools.
 */
class CircleCIService
{
    /**
     * @param  string  $accessToken  CircleCI personal API token.
     * @param  string  $baseUrl  CircleCI API base URL, without the /v2 suffix.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://circleci.com/api',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Get the current authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/v2/user');
    }

    /**
     * List pipelines visible to the authenticated user.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listPipelines(array $params = []): array
    {
        return $this->apiGet('/v2/pipeline', $params);
    }

    /**
     * Get details for a pipeline.
     *
     * @return array<string, mixed>
     */
    public function getPipeline(string $id): array
    {
        return $this->apiGet('/v2/pipeline/' . rawurlencode($id));
    }

    /**
     * List workflows for a pipeline.
     *
     * @return array<string, mixed>
     */
    public function listWorkflows(string $pipelineId): array
    {
        return $this->apiGet('/v2/pipeline/' . rawurlencode($pipelineId) . '/workflow');
    }

    /**
     * Get details for a workflow.
     *
     * @return array<string, mixed>
     */
    public function getWorkflow(string $id): array
    {
        return $this->apiGet('/v2/workflow/' . rawurlencode($id));
    }

    /**
     * List projects for an organization.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listProjects(array $params = []): array
    {
        return $this->apiGet('/v2/projects', $params);
    }

    /**
     * Trigger a new pipeline for a project slug such as gh/org/repo.
     *
     * @param  array<string, mixed>  $body  Request body.
     * @return array<string, mixed>
     */
    public function triggerPipeline(string $projectSlug, array $body = []): array
    {
        return $this->apiPost('/v2/project/' . $this->encodeSlug($projectSlug) . '/pipeline', $body);
    }

    /**
     * Send a GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, $query);
    }

    /**
     * Send a POST request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $data = [], array $query = []): array
    {
        return $this->request('POST', $path, $data, $query);
    }

    /**
     * Send a PATCH request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PATCH', $path, $data, $query);
    }

    /**
     * Send a PUT request.
     *
     * @param  array<string, mixed>  $data  JSON request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $data = [], array $query = []): array
    {
        return $this->request('PUT', $path, $data, $query);
    }

    /**
     * Send a DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, $query);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query params for GET/DELETE or JSON body for mutating requests.
     * @param  array<string, mixed>  $query  Query params for mutating requests.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $query);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to CircleCI.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     */
    private function rawRequest(string $method, string $path, array $data = [], array $query = []): Response
    {
        if ($this->accessToken === '') {
            throw new RuntimeException('CircleCI access token is not configured.');
        }

        $url = $this->baseUrl . '/' . ltrim($path, '/');

        try {
            $http = Http::withHeaders(['Circle-Token' => $this->accessToken])
                ->acceptJson()
                ->asJson()
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->withOptions(['query' => $query])->post($url, $data),
                'PATCH' => $http->withOptions(['query' => $query])->patch($url, $data),
                'PUT' => $http->withOptions(['query' => $query])->put($url, $data),
                'DELETE' => $http->withOptions(['query' => $data])->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();

                Log::error("CircleCI API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException('CircleCI API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("CircleCI API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to CircleCI API: {$e->getMessage()}");
        }
    }

    /**
     * Encode a CircleCI slug while preserving slash-separated path segments.
     */
    private function encodeSlug(string $slug): string
    {
        return implode('/', array_map(static fn (string $segment): string => rawurlencode($segment), explode('/', trim($slug, '/'))));
    }
}
