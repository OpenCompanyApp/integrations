<?php

namespace OpenCompany\Integrations\Phantombuster\Tools;

use OpenCompany\Integrations\Phantombuster\PhantombusterService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class PhantombusterGetContainer implements Tool
{
    public function __construct(
        private PhantombusterService $service,
    ) {}

    public function name(): string
    {
        return 'phantombuster_get_container';
    }

    public function description(): string
    {
        return 'Get details for a specific Phantombuster container (execution run), including its status, output, and logs.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The container ID (e.g., "9876543210987654321").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Phantombuster integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Container ID is required.');
            }

            $result = $this->service->getContainer($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
