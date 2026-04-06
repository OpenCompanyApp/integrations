<?php

namespace OpenCompany\Integrations\Knock\Tools;

use OpenCompany\Integrations\Knock\KnockService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KnockTriggerWorkflow implements Tool
{
    public function __construct(
        private KnockService $service,
    ) {}

    public function name(): string
    {
        return 'knock_trigger_workflow';
    }

    public function description(): string
    {
        return 'Trigger a notification workflow in Knock for one or more recipients. The workflow will execute its configured steps (email, Slack, in-app, etc.) for each recipient.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The workflow ID to trigger.'],
            'recipients' => ['type' => 'array', 'required' => true, 'description' => 'Array of recipient identifiers (user IDs or emails) to receive the notification.'],
            'data' => ['type' => 'array', 'description' => 'Payload data to pass to the workflow. Used in notification templates as merge variables.'],
            'cancellation_criteria' => ['type' => 'array', 'description' => 'Cancellation criteria for the workflow run. Allows automatic cancellation based on conditions.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Knock integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Workflow ID is required.');
            }

            if (empty($args['recipients']) || !is_array($args['recipients'])) {
                return ToolResult::error('Recipients must be a non-empty array of user IDs or emails.');
            }

            $result = $this->service->triggerWorkflow(
                $args['id'],
                $args['recipients'],
                $args['data'] ?? [],
                $args['cancellation_criteria'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
