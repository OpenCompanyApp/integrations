<?php

namespace OpenCompany\Integrations\Clockify\Tools;

use OpenCompany\Integrations\Clockify\ClockifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: clockify_list_workspaces
 *
 * Lists all Clockify workspaces the authenticated user belongs to.
 */
class ClockifyListWorkspaces implements Tool
{
    public function __construct(
        private ClockifyService $service,
    ) {}

    public function name(): string
    {
        return 'clockify_list_workspaces';
    }

    public function description(): string
    {
        return 'List all Clockify workspaces the authenticated user belongs to. Returns workspace IDs and names needed for other Clockify tools.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Clockify integration is not configured.');
            }

            $result = $this->service->listWorkspaces();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
