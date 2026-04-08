<?php

namespace OpenCompany\Integrations\N8n\Tools;

use OpenCompany\Integrations\N8n\N8nService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List n8n workflow executions.
 */
class N8nListExecutions implements Tool
{
    /** @param  N8nService  $service  The n8n API client */
    public function __construct(
        private N8nService $service,
    ) {}

    public function name(): string
    {
        return 'n8n_list_executions';
    }

    public function description(): string
    {
        return 'List n8n workflow executions. Supports filtering by status and workflow ID, with pagination.';
    }

    public function parameters(): array
    {
        return [
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of executions to return. Default: 100.'],
            'status' => ['type' => 'string', 'description' => 'Filter by execution status: error, success, waiting.'],
            'workflow_id' => ['type' => 'string', 'description' => 'Filter executions by workflow ID.'],
        ];
    }

    /**
     * Retrieve executions with optional filtering and pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (cursor, limit, status, workflow_id)
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
                'status' => 'status',
                'workflow_id' => 'workflowId',
            ];

            foreach ($mapping as $argKey => $paramKey) {
                if (isset($args[$argKey])) {
                    $params[$paramKey] = $args[$argKey];
                }
            }

            $result = $this->service->listExecutions($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
