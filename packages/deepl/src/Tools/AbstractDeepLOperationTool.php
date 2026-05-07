<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\DeepL\DeepLOperations;
use OpenCompany\Integrations\DeepL\DeepLService;

/**
 * Base class for generated DeepL OpenAPI operation tools.
 *
 * Handles parameter declarations, configured-state checks, and execution
 * through the shared DeepL API client.
 */
abstract class AbstractDeepLOperationTool implements Tool
{
    protected const TOOL_NAME = '';

    /**
     * @param  DeepLService  $service  DeepL HTTP API client.
     */
    public function __construct(protected DeepLService $service) {}

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
                'description' => $this->operation()['request_body']['description'] ?: 'Request body for the DeepL API operation.',
            ];
            $parameters['content_type'] = [
                'type' => 'string',
                'required' => false,
                'description' => 'Optional request content type override. Defaults to the first supported content type from the official OpenAPI operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the DeepL API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
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
        $operations = DeepLOperations::all();

        return $operations[static::TOOL_NAME] ?? [];
    }
}