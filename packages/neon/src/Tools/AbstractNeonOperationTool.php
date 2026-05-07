<?php

namespace OpenCompany\Integrations\Neon\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Neon\NeonOperations;
use OpenCompany\Integrations\Neon\NeonService;

/**
 * Base class for generated Neon OpenAPI operation tools.
 *
 * Handles parameter declarations, configured-state checks, and execution
 * through the shared Neon API client.
 */
abstract class AbstractNeonOperationTool implements Tool
{
    protected const TOOL_NAME = '';

    /**
     * @param  NeonService  $service  Neon HTTP API client.
     */
    public function __construct(protected NeonService $service) {}

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
                'type' => $this->operation()['request_body']['schema_type'] ?? 'object',
                'required' => (bool) ($this->operation()['request_body']['required'] ?? false),
                'description' => $this->operation()['request_body']['description'] ?: 'Request body for the Neon API operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Neon API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Neon integration is not configured.');
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
        $operations = NeonOperations::all();

        return $operations[static::TOOL_NAME] ?? [];
    }
}