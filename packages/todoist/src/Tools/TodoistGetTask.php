<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\Integrations\Core\Contracts\Tool;
use OpenCompany\Integrations\Core\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * Retrieve a single Todoist task by its ID.
 */
class TodoistGetTask implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_get_task';
    }

    public function description(): string
    {
        return 'Retrieve a single Todoist task by its ID, including all properties like labels, due date, and priority.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique ID of the task to retrieve.'],
        ];
    }

    /**
     * Retrieve a task by ID.
     *
     * @param array<string, mixed> $args Must contain 'id' key with the task ID.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $result = $this->service->getTask($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
