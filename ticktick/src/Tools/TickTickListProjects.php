<?php

namespace OpenCompany\Integrations\TickTick\Tools;

use OpenCompany\Integrations\TickTick\TickTickService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TickTickListProjects implements Tool
{
    public function __construct(
        private TickTickService $service,
    ) {}

    public function name(): string
    {
        return 'ticktick_list_projects';
    }

    public function description(): string
    {
        return 'List all TickTick projects (task lists). Returns project names, IDs, and metadata. Use this first to discover available projects before working with tasks.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('TickTick integration is not configured.');
            }

            $projects = $this->service->listProjects();

            if (empty($projects)) {
                return ToolResult::success('No projects found in your TickTick account.');
            }

            return ToolResult::success($projects);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
