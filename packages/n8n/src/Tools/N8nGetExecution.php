<?php

namespace OpenCompany\Integrations\N8n\Tools;

use OpenCompany\Integrations\N8n\N8nService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific n8n execution.
 */
class N8nGetExecution implements Tool
{
    /** @param  N8nService  $service  The n8n API client */
    public function __construct(
        private N8nService $service,
    ) {}

    public function name(): string
    {
        return 'n8n_get_execution';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific n8n workflow execution, including status, data, and node results.';
    }

    public function parameters(): array
    {
        return [
            'execution_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the execution to retrieve.'],
        ];
    }

    /**
     * Retrieve execution details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (execution_id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('n8n is not configured. Missing API key.');
        }

        $executionId = $args['execution_id'] ?? '';

        if (empty($executionId)) {
            return ToolResult::error('Execution ID is required.');
        }

        try {
            $result = $this->service->getExecution($executionId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
