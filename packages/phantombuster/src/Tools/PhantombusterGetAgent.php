<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\Integrations\Phantombuster\PhantombusterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PhantombusterGetAgent implements Tool
{
    public function __construct(
        private PhantombusterService $service,
    ) {}

    public function name(): string
    {
        return 'phantombuster_get_agent';
    }

    public function description(): string
    {
        return 'Get details for a specific Phantombuster agent, including its configuration, last run status, and output.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The agent ID (e.g., "1234567890123456789").'],
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

            $result = $this->service->getAgent($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
