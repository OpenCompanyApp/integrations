<?php

namespace OpenCompany\Integrations\Grafana\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Grafana\GrafanaOperations;
use OpenCompany\Integrations\Grafana\GrafanaService;

/**
 * Base class for generated Grafana OpenAPI operation tools.
 *
 * Handles parameter declarations, configured-state checks, and execution
 * through the shared Grafana API client.
 */
abstract class AbstractGrafanaOperationTool implements Tool
{
    protected const TOOL_NAME = '';

    /**
     * @param  GrafanaService  $service  Grafana HTTP API client.
     */
    public function __construct(protected GrafanaService $service) {}

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
            $contentTypes = $this->operation()['request_body']['content_types'] ?? [];
            $parameters['body'] = [
                'type' => in_array('application/yaml', $contentTypes, true) && !in_array('application/json', $contentTypes, true) ? 'string' : 'object',
                'required' => (bool) ($this->operation()['request_body']['required'] ?? false),
                'description' => 'Request body for the Grafana API operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Grafana API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Grafana integration is not configured.');
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
        $operations = GrafanaOperations::all();

        return $operations[static::TOOL_NAME] ?? [];
    }
}
