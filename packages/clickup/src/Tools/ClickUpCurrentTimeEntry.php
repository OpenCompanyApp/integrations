<?php

namespace OpenCompany\Integrations\ClickUp\Tools;

use OpenCompany\Integrations\ClickUp\ClickUpService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ClickUpCurrentTimeEntry implements Tool
{
    public function __construct(
        private ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_current_time_entry';
    }

    public function description(): string
    {
        return 'Get the currently running time tracking entry, if any.';
    }

    public function parameters(): array
    {
        return [
            'workspace_id' => ['type' => 'string', 'description' => 'Workspace ID. Uses configured default if omitted.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickUp integration is not configured.');
            }

            $workspaceId = $args['workspace_id'] ?? $this->service->getWorkspaceId();
            if (empty($workspaceId)) {
                return ToolResult::error('Workspace ID is required. Configure it in settings or pass workspace_id.');
            }

            $result = $this->service->getCurrentTimeEntry($workspaceId);
            $data = $result['data'] ?? null;

            if (empty($data)) {
                return ToolResult::success('No timer is currently running.');
            }

            return ToolResult::success([
                'id' => $data['id'] ?? '',
                'task' => $data['task']['name'] ?? $data['task_id'] ?? '',
                'description' => $data['description'] ?? '',
                'start' => isset($data['start']) ? ClickUpService::fromMillis((int) $data['start']) : '',
                'billable' => $data['billable'] ?? false,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
