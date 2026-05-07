<?php

namespace OpenCompany\Integrations\Docker\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Docker\DockerOperations;
use OpenCompany\Integrations\Docker\DockerService;

/**
 * Base class for generated Docker Hub OpenAPI operation tools.
 *
 * Handles parameter declarations, configured-state checks, and execution
 * through the shared Docker Hub API client.
 */
abstract class AbstractDockerOperationTool implements Tool
{
    protected const TOOL_NAME = '';

    /**
     * @param  DockerService  $service  Docker Hub HTTP API client.
     */
    public function __construct(protected DockerService $service) {}

    public function name(): string
    {
        return static::TOOL_NAME;
    }

    public function description(): string
    {
        return (string) ($this->operation()['name'] ?? static::TOOL_NAME);
    }

    public function parameters(): array
    {
        $parameters = [];

        foreach ($this->operation()['parameters'] ?? [] as $parameter) {
            $parameters[$parameter['name']] = [
                'type' => $parameter['schema_type'] ?? 'string',
                'required' => (bool) ($parameter['required'] ?? false),
                'description' => $parameter['description'] ?: ucfirst(str_replace('_', ' ', $parameter['name'])),
            ];
        }

        if (($this->operation()['request_body'] ?? null) !== null) {
            $parameters['body'] = [
                'type' => 'object',
                'required' => (bool) ($this->operation()['request_body']['required'] ?? false),
                'description' => 'Request body for the Docker Hub API operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Docker Hub API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Docker Hub integration is not configured.');
            }

            return ToolResult::success($this->service->executeOperation($this->operation(), $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * @return array<string, mixed>
     */
    protected function operation(): array
    {
        $operations = DockerOperations::all();

        return $operations[static::TOOL_NAME] ?? [];
    }
}
