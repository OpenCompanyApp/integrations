<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Todoist\TodoistService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TodoistGetTask implements Tool
{
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string { return 'todoist_get_task'; }
    public function description(): string { return 'Get detailed information about a Todoist task.'; }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The task ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }
            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }
            $task = $this->service->getTask($id);
            return ToolResult::success($task);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
