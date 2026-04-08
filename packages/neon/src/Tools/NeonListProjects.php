<?php

namespace OpenCompany\Integrations\Neon\Tools;

use OpenCompany\Integrations\Neon\NeonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NeonListProjects implements Tool
{
    public function __construct(
        private NeonService $service,
    ) {}

    public function name(): string
    {
        return 'neon_list_projects';
    }

    public function description(): string
    {
        return 'List all Neon projects in the organization. Returns project IDs, names, region, and status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Neon integration is not configured.');
            }

            $result = $this->service->listProjects();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
