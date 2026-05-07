<?php

namespace OpenCompany\Integrations\Bubble\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Bubble\BubbleService;

/**
 * Trigger a Bubble Workflow API endpoint with POST.
 *
 * Runs an exposed backend API workflow or initializes it for Detect data mode.
 */
class BubbleTriggerWorkflow implements Tool
{
    /**
     * @param  BubbleService  $service  The Bubble API service client
     */
    public function __construct(private BubbleService $service) {}

    public function name(): string
    {
        return 'bubble_trigger_workflow';
    }

    public function description(): string
    {
        return 'Trigger an exposed Bubble API workflow using POST.';
    }

    public function parameters(): array
    {
        return [
            'workflow' => ['type' => 'string', 'required' => true, 'description' => 'API workflow name.'],
            'payload' => ['type' => 'object', 'description' => 'JSON body sent to the workflow.'],
            'initialize' => ['type' => 'boolean', 'description' => 'Append /initialize for Bubble Detect data mode.'],
        ];
    }

    /**
     * Trigger POST workflow.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Bubble integration is not configured.');
            }

            return ToolResult::success($this->service->triggerWorkflow((string) ($args['workflow'] ?? ''), $args['payload'] ?? [], (bool) ($args['initialize'] ?? false)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
