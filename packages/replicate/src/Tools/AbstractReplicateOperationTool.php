<?php

namespace OpenCompany\Integrations\Replicate\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Replicate\ReplicateOperations;
use OpenCompany\Integrations\Replicate\ReplicateService;

/**
 * Base class for generated Replicate OpenAPI operation tools.
 *
 * Handles parameter declarations, configuration checks, and execution through
 * the shared Replicate API client.
 */
abstract class AbstractReplicateOperationTool implements Tool
{
    protected const TOOL_NAME = '';

    /**
     * @param  ReplicateService  $service  Replicate HTTP API client.
     */
    public function __construct(
        protected ReplicateService $service,
    ) {}

    public function name(): string
    {
        return static::TOOL_NAME;
    }

    public function description(): string
    {
        return (string) ($this->operation()['summary'] ?? static::TOOL_NAME);
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
                'description' => 'Request body for the Replicate API operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Replicate API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Replicate integration is not configured.');
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
        $operations = ReplicateOperations::all();

        return $operations[static::TOOL_NAME] ?? [];
    }
}