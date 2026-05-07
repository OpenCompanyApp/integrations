<?php

namespace OpenCompany\Integrations\Bubble\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Bubble\BubbleService;

/**
 * Trigger a Bubble Workflow API endpoint with GET.
 *
 * Sends querystring parameters to a workflow configured for GET requests.
 */
class BubbleTriggerWorkflowGet implements Tool
{
    /**
     * @param  BubbleService  $service  The Bubble API service client
     */
    public function __construct(private BubbleService $service) {}

    public function name(): string
    {
        return 'bubble_trigger_workflow_get';
    }

    public function description(): string
    {
        return 'Trigger an exposed Bubble API workflow using GET query parameters.';
    }

    public function parameters(): array
    {
        return [
            'workflow' => ['type' => 'string', 'required' => true, 'description' => 'API workflow name.'],
            'params' => ['type' => 'object', 'description' => 'Query parameters sent to the workflow.'],
        ];
    }

    /**
     * Trigger GET workflow.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Bubble integration is not configured.');
            }

            return ToolResult::success($this->service->triggerWorkflowGet((string) ($args['workflow'] ?? ''), $args['params'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
