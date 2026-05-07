<?php

namespace OpenCompany\Integrations\SemaphoreCi\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SemaphoreCi\SemaphoreCiService;

/**
 * Shared executor for Semaphore CI tools.
 *
 * Child tools define metadata and operation names while this class validates
 * required arguments, maps query/body data, and dispatches service calls.
 */
abstract class AbstractSemaphoreCiTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  SemaphoreCiService  $service  Semaphore API client.
     */
    public function __construct(protected SemaphoreCiService $service) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        return static::PARAMETERS;
    }

    /**
     * Execute the Semaphore operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Semaphore CI integration is not configured.');
            }

            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            return ToolResult::success($this->dispatch($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Dispatch to the mapped service method.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function dispatch(array $args): array
    {
        return match (static::METHOD) {
            'runWorkflow' => $this->service->runWorkflow($this->payload($args)),
            'getWorkflow' => $this->service->getWorkflow((string) $args['workflow_id']),
            'listWorkflows' => $this->service->listWorkflows($this->query($args)),
            'rerunWorkflow' => $this->service->rerunWorkflow((string) $args['workflow_id'], (string) $args['request_token']),
            'stopWorkflow' => $this->service->stopWorkflow((string) $args['workflow_id']),
            'getPipeline' => $this->service->getPipeline((string) $args['pipeline_id'], $this->query($args)),
            'listPipelines' => $this->service->listPipelines($this->query($args)),
            'stopPipeline' => $this->service->stopPipeline((string) $args['pipeline_id']),
            'partialRebuildPipeline' => $this->service->partialRebuildPipeline((string) $args['pipeline_id'], $this->payload($args)),
            'validateYaml' => $this->service->validateYaml($this->payload($args)),
            'listPromotions' => $this->service->listPromotions($this->query($args)),
            'triggerPromotion' => $this->service->triggerPromotion($this->payload($args)),
            'triggerTask' => $this->service->triggerTask((string) $args['task_id'], $this->payload($args)),
            'getJob' => $this->service->getJob((string) $args['job_id']),
            'stopJob' => $this->service->stopJob((string) $args['job_id']),
            'getJobLogs' => $this->service->getJobLogs((string) $args['job_id'], $this->query($args)),
            'listAgentTypes' => $this->service->listAgentTypes(),
            'createAgentType' => $this->service->createAgentType($this->payload($args)),
            'updateAgentType' => $this->service->updateAgentType((string) $args['agent_type_name'], $this->payload($args)),
            'getAgentType' => $this->service->getAgentType((string) $args['agent_type_name']),
            'deleteAgentType' => $this->service->deleteAgentType((string) $args['agent_type_name']),
            'disableAgentTypeAgents' => $this->service->disableAgentTypeAgents((string) $args['agent_type_name'], $this->payload($args)),
            'listAgents' => $this->service->listAgents($this->query($args)),
            'getAgent' => $this->service->getAgent((string) $args['agent_name']),
            'listDeploymentTargets' => $this->service->listDeploymentTargets($this->query($args)),
            'getDeploymentTarget' => $this->service->getDeploymentTarget((string) $args['target_id']),
            'createDeploymentTarget' => $this->service->createDeploymentTarget($this->query($args), $this->payload($args)),
            'updateDeploymentTarget' => $this->service->updateDeploymentTarget((string) $args['target_id'], $this->payload($args)),
            'deleteDeploymentTarget' => $this->service->deleteDeploymentTarget((string) $args['target_id'], $this->query($args)),
            'deactivateDeploymentTarget' => $this->service->deactivateDeploymentTarget((string) $args['target_id']),
            'activateDeploymentTarget' => $this->service->activateDeploymentTarget((string) $args['target_id']),
            'getDeploymentHistory' => $this->service->getDeploymentHistory((string) $args['target_id'], $this->query($args)),
            'listArtifacts' => $this->service->listArtifacts($this->query($args)),
            'getArtifactSignedUrl' => $this->service->getArtifactSignedUrl($this->query($args)),
            'configureArtifactRetentionPolicy' => $this->service->configureArtifactRetentionPolicy($this->payload($args)),
            'getArtifactRetentionPolicy' => $this->service->getArtifactRetentionPolicy((string) $args['project_id']),
            'apiGet' => $this->service->apiGet((string) $args['path'], $this->query($args)),
            'apiPost' => $this->service->apiPost((string) $args['path'], $this->payload($args)),
            'apiPatch' => $this->service->apiPatch((string) $args['path'], $this->payload($args)),
            'apiDelete' => $this->service->apiDelete((string) $args['path'], $this->query($args)),
            default => throw new InvalidArgumentException('Unsupported Semaphore CI operation.'),
        };
    }

    /**
     * Return explicit payload object or inferred write fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function payload(array $args): array
    {
        if (isset($args['payload']) && is_array($args['payload'])) {
            return $args['payload'];
        }

        $payload = $args;
        foreach (['workflow_id', 'pipeline_id', 'task_id', 'job_id', 'agent_type_name', 'agent_name', 'target_id', 'project_id', 'path', 'query', 'payload'] as $key) {
            unset($payload[$key]);
        }

        return $payload;
    }

    /**
     * Return explicit query object or inferred read fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function query(array $args): array
    {
        if (isset($args['query']) && is_array($args['query'])) {
            return $args['query'];
        }

        $query = $args;
        foreach (['workflow_id', 'pipeline_id', 'task_id', 'job_id', 'agent_type_name', 'agent_name', 'target_id', 'path', 'payload'] as $key) {
            unset($query[$key]);
        }

        return $query;
    }

    /**
     * Ensure a required value is present.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireValue(array $args, string $key): void
    {
        $value = $args[$key] ?? null;
        if ($value === null || $value === '' || (is_array($value) && $value === [])) {
            throw new InvalidArgumentException($key.' is required.');
        }
    }
}
