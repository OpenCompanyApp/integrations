<?php

namespace OpenCompany\Integrations\SemaphoreCi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for Semaphore API v1alpha.
 *
 * Handles token authentication, required API headers, base URL normalization,
 * JSON response parsing, and normalized Semaphore API errors.
 */
class SemaphoreCiService
{
    /**
     * @param  string  $apiToken  Semaphore API token.
     * @param  string  $baseUrl  Organization API root or organization URL.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = $this->normalizeBaseUrl($this->baseUrl);
    }

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return trim($this->apiToken) !== '' && trim($this->baseUrl) !== '';
    }

    /**
     * Run a workflow for a project and git reference.
     *
     * @param  array<string, mixed>  $payload  Workflow run payload.
     * @return array<string, mixed>
     */
    public function runWorkflow(array $payload): array
    {
        return $this->request('POST', '/plumber-workflows', $payload);
    }

    /**
     * Get one workflow by id.
     *
     * @return array<string, mixed>
     */
    public function getWorkflow(string $workflowId): array
    {
        return $this->request('GET', '/plumber-workflows/'.$this->segment($workflowId));
    }

    /**
     * List workflows for a project.
     *
     * @param  array<string, mixed>  $query  Project, branch, and timestamp filters.
     * @return array<string, mixed>
     */
    public function listWorkflows(array $query): array
    {
        return $this->request('GET', '/plumber-workflows', $query);
    }

    /**
     * Rerun a workflow.
     *
     * @return array<string, mixed>
     */
    public function rerunWorkflow(string $workflowId, string $requestToken): array
    {
        return $this->request('POST', '/plumber-workflows/'.$this->segment($workflowId).'/reschedule', ['request_token' => $requestToken], true);
    }

    /**
     * Stop a workflow.
     *
     * @return array<string, mixed>
     */
    public function stopWorkflow(string $workflowId): array
    {
        return $this->request('POST', '/plumber-workflows/'.$this->segment($workflowId).'/terminate');
    }

    /**
     * Get one pipeline by id.
     *
     * @param  array<string, mixed>  $query  Optional detailed query.
     * @return array<string, mixed>
     */
    public function getPipeline(string $pipelineId, array $query = []): array
    {
        return $this->request('GET', '/pipelines/'.$this->segment($pipelineId), $query);
    }

    /**
     * List pipelines by project or workflow id.
     *
     * @param  array<string, mixed>  $query  Project, workflow, branch, YAML, and timestamp filters.
     * @return array<string, mixed>
     */
    public function listPipelines(array $query): array
    {
        return $this->request('GET', '/pipelines', $query);
    }

    /**
     * Stop a pipeline.
     *
     * @return array<string, mixed>
     */
    public function stopPipeline(string $pipelineId): array
    {
        return $this->request('PATCH', '/pipelines/'.$this->segment($pipelineId), ['terminate_request' => true]);
    }

    /**
     * Rebuild failed blocks in a pipeline.
     *
     * @param  array<string, mixed>  $payload  Partial rebuild payload.
     * @return array<string, mixed>
     */
    public function partialRebuildPipeline(string $pipelineId, array $payload): array
    {
        return $this->request('POST', '/pipelines/'.$this->segment($pipelineId).'/partial_rebuild', $payload);
    }

    /**
     * Validate a Semaphore pipeline YAML document.
     *
     * @param  array<string, mixed>  $payload  YAML validation payload.
     * @return array<string, mixed>
     */
    public function validateYaml(array $payload): array
    {
        return $this->request('POST', '/yaml', $payload);
    }

    /**
     * List promotions for a pipeline.
     *
     * @param  array<string, mixed>  $query  Promotion query parameters.
     * @return array<string, mixed>
     */
    public function listPromotions(array $query): array
    {
        return $this->request('GET', '/promotions', $query);
    }

    /**
     * Trigger a promotion.
     *
     * @param  array<string, mixed>  $payload  Promotion trigger payload.
     * @return array<string, mixed>
     */
    public function triggerPromotion(array $payload): array
    {
        return $this->request('POST', '/promotions', $payload);
    }

    /**
     * Trigger a task immediately.
     *
     * @param  array<string, mixed>  $payload  Optional task run payload.
     * @return array<string, mixed>
     */
    public function triggerTask(string $taskId, array $payload = []): array
    {
        return $this->request('POST', '/tasks/'.$this->segment($taskId).'/run_now', $payload);
    }

    /**
     * Get one job by id.
     *
     * @return array<string, mixed>
     */
    public function getJob(string $jobId): array
    {
        return $this->request('GET', '/jobs/'.$this->segment($jobId));
    }

    /**
     * Stop one job by id.
     *
     * @return array<string, mixed>
     */
    public function stopJob(string $jobId): array
    {
        return $this->request('POST', '/jobs/'.$this->segment($jobId).'/stop');
    }

    /**
     * Get job logs.
     *
     * @param  array<string, mixed>  $query  Log query parameters.
     * @return array<string, mixed>
     */
    public function getJobLogs(string $jobId, array $query = []): array
    {
        return $this->request('GET', '/logs/'.$this->segment($jobId), $query);
    }

    /**
     * List self-hosted agent types.
     *
     * @return array<string, mixed>
     */
    public function listAgentTypes(): array
    {
        return $this->request('GET', '/self_hosted_agent_types');
    }

    /**
     * Create a self-hosted agent type.
     *
     * @param  array<string, mixed>  $payload  Agent type payload.
     * @return array<string, mixed>
     */
    public function createAgentType(array $payload): array
    {
        return $this->request('POST', '/self_hosted_agent_types', $payload);
    }

    /**
     * Update a self-hosted agent type.
     *
     * @param  array<string, mixed>  $payload  Agent type payload.
     * @return array<string, mixed>
     */
    public function updateAgentType(string $agentTypeName, array $payload): array
    {
        return $this->request('PATCH', '/self_hosted_agent_types/'.$this->segment($agentTypeName), $payload);
    }

    /**
     * Get one self-hosted agent type.
     *
     * @return array<string, mixed>
     */
    public function getAgentType(string $agentTypeName): array
    {
        return $this->request('GET', '/self_hosted_agent_types/'.$this->segment($agentTypeName));
    }

    /**
     * Delete one self-hosted agent type.
     *
     * @return array<string, mixed>
     */
    public function deleteAgentType(string $agentTypeName): array
    {
        return $this->request('DELETE', '/self_hosted_agent_types/'.$this->segment($agentTypeName));
    }

    /**
     * Disable agents for one agent type.
     *
     * @param  array<string, mixed>  $payload  Optional only_idle flag.
     * @return array<string, mixed>
     */
    public function disableAgentTypeAgents(string $agentTypeName, array $payload = []): array
    {
        return $this->request('POST', '/self_hosted_agent_types/'.$this->segment($agentTypeName).'/disable_all', $payload);
    }

    /**
     * List self-hosted agents.
     *
     * @param  array<string, mixed>  $query  Agent type, page size, and cursor query.
     * @return array<string, mixed>
     */
    public function listAgents(array $query = []): array
    {
        return $this->request('GET', '/agents', $query);
    }

    /**
     * Get one self-hosted agent by name.
     *
     * @return array<string, mixed>
     */
    public function getAgent(string $agentName): array
    {
        return $this->request('GET', '/agents/'.$this->segment($agentName));
    }

    /**
     * List deployment targets for a project.
     *
     * @param  array<string, mixed>  $query  Project id and optional target name.
     * @return array<string, mixed>
     */
    public function listDeploymentTargets(array $query): array
    {
        return $this->request('GET', '/deployment_targets', $query);
    }

    /**
     * Get one deployment target.
     *
     * @return array<string, mixed>
     */
    public function getDeploymentTarget(string $targetId): array
    {
        return $this->request('GET', '/deployment_targets/'.$this->segment($targetId));
    }

    /**
     * Create a deployment target.
     *
     * @param  array<string, mixed>  $payload  Deployment target payload.
     * @return array<string, mixed>
     */
    public function createDeploymentTarget(array $query, array $payload): array
    {
        return $this->request('POST', '/deployment_targets', array_merge(['_query' => $query], $payload));
    }

    /**
     * Update a deployment target.
     *
     * @param  array<string, mixed>  $payload  Deployment target payload.
     * @return array<string, mixed>
     */
    public function updateDeploymentTarget(string $targetId, array $payload): array
    {
        return $this->request('PATCH', '/deployment_targets/'.$this->segment($targetId), $payload);
    }

    /**
     * Delete a deployment target.
     *
     * @param  array<string, mixed>  $query  Query parameters, including unique_token.
     * @return array<string, mixed>
     */
    public function deleteDeploymentTarget(string $targetId, array $query): array
    {
        return $this->request('DELETE', '/deployment_targets/'.$this->segment($targetId), $query);
    }

    /**
     * Deactivate a deployment target.
     *
     * @return array<string, mixed>
     */
    public function deactivateDeploymentTarget(string $targetId): array
    {
        return $this->request('PATCH', '/deployment_targets/'.$this->segment($targetId).'/deactivate');
    }

    /**
     * Activate a deployment target.
     *
     * @return array<string, mixed>
     */
    public function activateDeploymentTarget(string $targetId): array
    {
        return $this->request('PATCH', '/deployment_targets/'.$this->segment($targetId).'/activate');
    }

    /**
     * Retrieve deployment history.
     *
     * @param  array<string, mixed>  $query  History cursor and filter query.
     * @return array<string, mixed>
     */
    public function getDeploymentHistory(string $targetId, array $query = []): array
    {
        return $this->request('GET', '/deployment_targets/'.$this->segment($targetId).'/history', $query);
    }

    /**
     * List artifacts under a project, workflow, or job scope.
     *
     * @param  array<string, mixed>  $query  Artifact scope query.
     * @return array<string, mixed>
     */
    public function listArtifacts(array $query): array
    {
        return $this->request('GET', '/artifacts', $query);
    }

    /**
     * Get a signed artifact URL.
     *
     * @param  array<string, mixed>  $query  Artifact signed URL query.
     * @return array<string, mixed>
     */
    public function getArtifactSignedUrl(array $query): array
    {
        return $this->request('GET', '/artifacts/signed_url', $query);
    }

    /**
     * Configure artifact retention policies.
     *
     * @param  array<string, mixed>  $payload  Retention policy payload.
     * @return array<string, mixed>
     */
    public function configureArtifactRetentionPolicy(array $payload): array
    {
        return $this->request('POST', '/artifacts_retention_policies', $payload);
    }

    /**
     * Get artifact retention policy for a project.
     *
     * @return array<string, mixed>
     */
    public function getArtifactRetentionPolicy(string $projectId): array
    {
        return $this->request('GET', '/artifacts_retention_policies/'.$this->segment($projectId));
    }

    /**
     * Execute a safe raw GET request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $query);
    }

    /**
     * Execute a safe raw POST request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a safe raw PATCH request.
     *
     * @param  array<string, mixed>  $payload  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a safe raw DELETE request.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $query);
    }

    /**
     * Dispatch a Semaphore API request.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $forceQuery = false): array
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Semaphore CI API URL and token are required.');
        }

        $query = [];
        if (isset($data['_query']) && is_array($data['_query'])) {
            $query = $data['_query'];
            unset($data['_query']);
        }

        $response = $this->rawRequest($method, $path, $data, $forceQuery, $query);
        if (!$response->successful()) {
            $this->throwApiError($method, $path, $response);
        }

        return $this->decodeResponse($response);
    }

    /**
     * Make a raw HTTP request to Semaphore.
     *
     * @param  array<string, mixed>  $data  Query parameters or JSON request body.
     * @param  array<string, mixed>  $extraQuery  Query parameters applied with JSON body requests.
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $forceQuery = false, array $extraQuery = []): Response
    {
        $url = $this->baseUrl.$path;
        $http = Http::withHeaders([
            'Authorization' => 'Token '.$this->apiToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'User-Agent' => 'SemaphoreCI v2.0 Client',
        ])->timeout(30);

        if ($extraQuery !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?').http_build_query($extraQuery);
        }

        try {
            return match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $forceQuery ? $http->post($url.(($data !== []) ? ((str_contains($url, '?') ? '&' : '?').http_build_query($data)) : '')) : $http->post($url, $data),
                'PATCH' => $forceQuery ? $http->patch($url.(($data !== []) ? ((str_contains($url, '?') ? '&' : '?').http_build_query($data)) : '')) : $http->patch($url, $data),
                'DELETE' => $data === [] ? $http->delete($url) : $http->send('DELETE', $url, ['query' => $data]),
                default => throw new RuntimeException("Unsupported Semaphore CI method: {$method}"),
            };
        } catch (\Throwable $e) {
            Log::error("Semaphore CI API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException('Failed to connect to Semaphore CI API: '.$e->getMessage());
        }
    }

    /**
     * Throw a normalized Semaphore API error.
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $json = $response->json();
        $message = is_array($json)
            ? (string) ($json['message'] ?? $json['error'] ?? $json['error_message'] ?? '')
            : '';
        $message = $message !== '' ? $message : trim($response->body());

        Log::error("Semaphore CI API error: {$method} {$path}", ['status' => $response->status(), 'body' => $response->body()]);

        throw new RuntimeException('Semaphore CI API error ('.$response->status().'): '.($message !== '' ? $message : 'Unexpected API error.'));
    }

    /**
     * Decode a JSON or text Semaphore response.
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

    private function normalizeBaseUrl(string $url): string
    {
        $url = rtrim(trim($url), '/');
        if ($url === '') {
            return '';
        }

        return str_ends_with($url, '/api/v1alpha') ? $url : $url.'/api/v1alpha';
    }

    private function segment(string $value): string
    {
        return rawurlencode($value);
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path);
        if ($path === '' || str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            throw new RuntimeException('Semaphore CI API path must be a non-empty relative path.');
        }

        if (str_starts_with($path, '/api/v1alpha/')) {
            $path = substr($path, strlen('/api/v1alpha'));
        }

        return '/'.ltrim($path, '/');
    }
}
