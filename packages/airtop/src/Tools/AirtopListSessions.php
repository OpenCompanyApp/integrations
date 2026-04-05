<?php

namespace OpenCompany\Integrations\Airtop\Tools;

use OpenCompany\Integrations\Airtop\AirtopService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AirtopListSessions implements Tool
{
    public function __construct(
        private AirtopService $service,
    ) {}

    public function name(): string
    {
        return 'airtop_list_sessions';
    }

    public function description(): string
    {
        return 'List all active browser sessions in Airtop. Returns session IDs and their current status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Airtop integration is not configured.');
            }

            $result = $this->service->listSessions();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
