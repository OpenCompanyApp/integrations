<?php

namespace OpenCompany\Integrations\N8n\Tools;

use OpenCompany\Integrations\N8n\N8nService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a specific n8n workflow.
 */
class N8nGetWorkflow implements Tool
{
    /** @param  N8nService  $service  The n8n API client */
    public function __construct(
        private N8nService $service,
    ) {}

    public function name(): string
    {
        return 'n8n_get_workflow';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific n8n workflow, including its nodes, connections, and settings.';
    }

    public function parameters(): array
    {
        return [
            'workflow_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the workflow to retrieve.'],
        ];
    }

    /**
     * Retrieve workflow details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (workflow_id)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('n8n is not configured. Missing API key.');
        }

        $workflowId = $args['workflow_id'] ?? '';

        if (empty($workflowId)) {
            return ToolResult::error('Workflow ID is required.');
        }

        try {
            $result = $this->service->getWorkflow($workflowId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
