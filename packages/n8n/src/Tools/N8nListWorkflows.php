<?php

namespace OpenCompany\Integrations\N8n\Tools;

use OpenCompany\Integrations\N8n\N8nService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List n8n workflows.
 */
class N8nListWorkflows implements Tool
{
    /** @param  N8nService  $service  The n8n API client */
    public function __construct(
        private N8nService $service,
    ) {}

    public function name(): string
    {
        return 'n8n_list_workflows';
    }

    public function description(): string
    {
        return 'List n8n workflows. Supports pagination with cursor and limit parameters.';
    }

    public function parameters(): array
    {
        return [
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of workflows to return. Default: 100.'],
        ];
    }

    /**
     * Retrieve workflows with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (cursor, limit)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('n8n is not configured. Missing API key.');
        }

        try {
            $params = [];

            $mapping = [
                'cursor' => 'cursor',
                'limit' => 'limit',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listWorkflows($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
