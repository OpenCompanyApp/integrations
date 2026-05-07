<?php

namespace OpenCompany\Integrations\ArgoCd\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ArgoCd\ArgoCdOperations;
use OpenCompany\Integrations\ArgoCd\ArgoCdService;

/**
 * Base class for generated Argo CD Swagger operation tools.
 *
 * Handles parameter declarations, configured-state checks, and execution
 * through the shared Argo CD API client.
 */
abstract class AbstractArgoCdOperationTool implements Tool
{
    protected const TOOL_NAME = '';

    /**
     * @param  ArgoCdService  $service  Argo CD HTTP API client.
     */
    public function __construct(protected ArgoCdService $service) {}

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
                'description' => $this->operation()['request_body']['description'] ?: 'Request body for the Argo CD API operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Argo CD API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (($this->operation()['auth_required'] ?? true) && !$this->service->isConfigured()) {
                return ToolResult::error('Argo CD integration is not configured.');
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
        $operations = ArgoCdOperations::all();

        return $operations[static::TOOL_NAME] ?? [];
    }
}