<?php

namespace OpenCompany\Integrations\Buildkite\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Buildkite\BuildkiteService;

/**
 * Shared executor for Buildkite tools.
 *
 * Child tools define metadata and operation names while this class validates
 * required arguments, maps snake_case payloads, and dispatches service calls.
 */
abstract class AbstractBuildkiteTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = '';
    protected const REQUIRED = [];

    /**
     * @param  BuildkiteService  $service  Buildkite API client.
     */
    public function __construct(protected BuildkiteService $service) {}

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
     * Execute the Buildkite operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buildkite integration is not configured.');
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
            'getCurrentUser' => $this->service->getCurrentUser(),
            'listOrganizations' => $this->service->listOrganizations($this->query($args)),
            'getOrganization' => $this->service->getOrganization((string) $args['organization']),
            'listPipelines' => $this->service->listPipelines((string) $args['organization'], $this->query($args)),
            'getPipeline' => $this->service->getPipeline((string) $args['organization'], (string) $args['pipeline']),
            'createPipeline' => $this->service->createPipeline((string) $args['organization'], $this->payload($args)),
            'updatePipeline' => $this->service->updatePipeline((string) $args['organization'], (string) $args['pipeline'], $this->payload($args)),
            'archivePipeline' => $this->service->archivePipeline((string) $args['organization'], (string) $args['pipeline']),
            'unarchivePipeline' => $this->service->unarchivePipeline((string) $args['organization'], (string) $args['pipeline']),
            'listBuilds' => $this->service->listBuilds((string) $args['organization'], (string) $args['pipeline'], $this->query($args)),
            'getBuild' => $this->service->getBuild((string) $args['organization'], (string) $args['pipeline'], $args['number']),
            'createBuild' => $this->service->createBuild((string) $args['organization'], (string) $args['pipeline'], $this->payload($args)),
            'cancelBuild' => $this->service->cancelBuild((string) $args['organization'], (string) $args['pipeline'], $args['number']),
            'rebuildBuild' => $this->service->rebuildBuild((string) $args['organization'], (string) $args['pipeline'], $args['number']),
            'retryFailedJobs' => $this->service->retryFailedJobs((string) $args['organization'], (string) $args['pipeline'], $args['number'], $this->payload($args)),
            'getJobLog' => $this->service->getJobLog((string) $args['organization'], (string) $args['pipeline'], $args['number'], (string) $args['job_id']),
            'getJobEnvironment' => $this->service->getJobEnvironment((string) $args['organization'], (string) $args['pipeline'], $args['number'], (string) $args['job_id']),
            'apiGet' => $this->service->apiGet((string) $args['path'], $this->query($args)),
            'apiPost' => $this->service->apiPost((string) $args['path'], $this->payload($args)),
            'apiPut' => $this->service->apiPut((string) $args['path'], $this->payload($args)),
            'apiPatch' => $this->service->apiPatch((string) $args['path'], $this->payload($args)),
            'apiDelete' => $this->service->apiDelete((string) $args['path'], $this->query($args)),
            default => throw new InvalidArgumentException('Unsupported Buildkite operation.'),
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
        foreach (['organization', 'pipeline', 'number', 'job_id', 'path', 'query', 'payload'] as $key) {
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
        foreach (['organization', 'pipeline', 'number', 'job_id', 'path', 'payload'] as $key) {
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
