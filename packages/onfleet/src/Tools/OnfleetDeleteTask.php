<?php

namespace OpenCompany\Integrations\Onfleet\Tools;

use OpenCompany\Integrations\Onfleet\OnfleetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a delivery task from Onfleet.
 *
 * Permanently removes a task. Only unassigned or unsuccessfully completed
 * tasks can be deleted.
 */
class OnfleetDeleteTask implements Tool
{
    public function __construct(
        private OnfleetService $service,
    ) {}

    public function name(): string
    {
        return 'onfleet_delete_task';
    }

    public function description(): string
    {
        return 'Delete a delivery task from Onfleet. Only unassigned or unsuccessfully completed tasks can be deleted. This action is permanent.';
    }

    public function parameters(): array
    {
        return [
            'task_id' => ['type' => 'string', 'required' => true, 'description' => 'The Onfleet task ID to delete (24-character hex string).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Onfleet integration is not configured.');
            }

            if (empty($args['task_id'])) {
                return ToolResult::error('Task ID is required.');
            }

            $this->service->deleteTask($args['task_id']);

            return ToolResult::success("Task '{$args['task_id']}' has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
