<?php

namespace OpenCompany\Integrations\CockroachDb\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\CockroachDb\CockroachDbOperations;
use OpenCompany\Integrations\CockroachDb\CockroachDbService;

/**
 * Base class for generated CockroachDB Cloud OpenAPI operation tools.
 *
 * Handles parameter declarations, configured-state checks, and execution
 * through the shared CockroachDB Cloud API client.
 */
abstract class AbstractCockroachDbOperationTool implements Tool
{
    protected const TOOL_NAME = '';

    /**
     * @param  CockroachDbService  $service  CockroachDB Cloud HTTP API client.
     */
    public function __construct(protected CockroachDbService $service) {}

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
                'description' => 'Request body for the CockroachDB Cloud API operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the CockroachDB Cloud API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('CockroachDB Cloud integration is not configured.');
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
        $operations = CockroachDbOperations::all();

        return $operations[static::TOOL_NAME] ?? [];
    }
}
