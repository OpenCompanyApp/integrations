<?php

namespace OpenCompany\Integrations\Close\Tools;

use OpenCompany\Integrations\Close\CloseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: Create Task.
 *
 * Creates a new task in Close CRM, optionally associated with a lead and
 * assigned to a user with an optional due date.
 *
 * @see https://developer.close.com/resources/tasks/#create-a-task
 */
class CloseCreateTask implements Tool
{
    /**
     * @param  CloseService  $service  The Close API service instance.
     */
    public function __construct(
        private CloseService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'close_create_task';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Create a new task in Close CRM. Optionally associate it with a lead, assign it to a user, and set a due date.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'text'        => ['type' => 'string', 'required' => true, 'description' => 'The task description or body text.'],
            'lead_id'     => ['type' => 'string', 'description' => 'Associate this task with a lead (e.g., "lead_abc123XYZ").'],
            'assignee_id' => ['type' => 'string', 'description' => 'User ID to assign the task to (e.g., "user_abc123XYZ").'],
            'due_date'    => ['type' => 'string', 'description' => 'Due date in ISO 8601 format (e.g., "2026-04-15").'],
            'is_complete' => ['type' => 'boolean', 'description' => 'Whether the task is already completed (default: false).'],
        ];
    }

    /**
     * Execute the create task tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (text, lead_id, assignee_id, due_date, is_complete).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Close integration is not configured.');
            }

            $text = $args['text'] ?? '';
            if (empty($text)) {
                return ToolResult::error('Task text is required.');
            }

            $result = $this->service->createTask(
                text: $text,
                leadId: $args['lead_id'] ?? null,
                assigneeId: $args['assignee_id'] ?? null,
                dueDate: $args['due_date'] ?? null,
                isComplete: (bool) ($args['is_complete'] ?? false),
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
