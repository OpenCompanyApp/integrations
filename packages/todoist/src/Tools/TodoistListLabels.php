<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Todoist\TodoistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TodoistListLabels implements Tool
{
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string { return 'todoist_list_labels'; }
    public function description(): string { return 'List all personal labels in Todoist.'; }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }
            $labels = $this->service->listLabels();
            return ToolResult::success($labels);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
