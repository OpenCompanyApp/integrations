<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DevinListSessions implements Tool
{
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_list_sessions';
    }

    public function description(): string
    {
        return 'List all Devin sessions. Returns an overview of all sessions including their IDs, statuses, and creation times.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $result = $this->service->listSessions();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
