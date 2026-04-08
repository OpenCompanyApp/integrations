<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\Integrations\Phantombuster\PhantombusterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PhantombusterLaunchAgent implements Tool
{
    public function __construct(
        private PhantombusterService $service,
    ) {}

    public function name(): string
    {
        return 'phantombuster_launch_agent';
    }

    public function description(): string
    {
        return 'Launch a Phantombuster agent to start an automation. Returns the container ID for tracking execution progress.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The agent ID to launch (e.g., "1234567890123456789").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Phantombuster integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Agent ID is required.');
            }

            $result = $this->service->launchAgent($args['id']);

            return ToolResult::success([
                'message' => "Agent {$args['id']} has been launched.",
                'container' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
