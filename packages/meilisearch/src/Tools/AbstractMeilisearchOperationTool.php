<?php

namespace OpenCompany\Integrations\Meilisearch\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Meilisearch\MeilisearchOperations;
use OpenCompany\Integrations\Meilisearch\MeilisearchService;

/**
 * Base class for generated Meilisearch OpenAPI operation tools.
 *
 * Handles parameter declarations, service checks, and execution through the
 * shared Meilisearch API client.
 */
abstract class AbstractMeilisearchOperationTool implements Tool
{
    protected const TOOL_NAME = '';

    /**
     * @param  MeilisearchService  $service  Meilisearch HTTP API client.
     */
    public function __construct(
        protected MeilisearchService $service,
    ) {}

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
                'type' => in_array('text/plain', $contentTypes, true) ? 'string' : 'object',
                'required' => (bool) ($this->operation()['request_body']['required'] ?? false),
                'description' => 'Request body for the Meilisearch API operation.',
            ];
        }

        return $parameters;
    }

    /**
     * Execute the Meilisearch API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Meilisearch integration is not configured.');
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
        $operations = MeilisearchOperations::all();

        return $operations[static::TOOL_NAME] ?? [];
    }
}
