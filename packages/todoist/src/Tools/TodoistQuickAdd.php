<?php

namespace OpenCompany\Integrations\Todoist\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Todoist\TodoistService;

/**
 * Quick-add a Todoist task using natural language parsing.
 */
class TodoistQuickAdd implements Tool
{
    /**
     * @param TodoistService $service The Todoist API service instance.
     */
    public function __construct(
        private TodoistService $service,
    ) {}

    public function name(): string
    {
        return 'todoist_quick_add';
    }

    public function description(): string
    {
        return 'Add a task using Todoist\'s natural language quick-add. Examples: "Buy milk tomorrow", "Meeting with team every Monday @Work p1".';
    }

    public function parameters(): array
    {
        return [
            'text' => ['type' => 'string', 'required' => true, 'description' => 'Natural language task text (e.g., "Buy milk tomorrow @Groceries").'],
            'note' => ['type' => 'string', 'required' => false, 'description' => 'Note to attach to the task.'],
            'reminder' => ['type' => 'string', 'required' => false, 'description' => 'Reminder in natural language (e.g., "30 minutes before").'],
            'auto_reminder' => ['type' => 'boolean', 'required' => false, 'description' => 'Whether to add an automatic reminder.'],
        ];
    }

    /**
     * Quick-add a task using Todoist's natural language parser.
     *
     * @param array<string, mixed> $args Must contain 'text'; optional 'note', 'reminder', 'auto_reminder'.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Todoist integration is not configured.');
            }

            $result = $this->service->quickAdd(
                text: $args['text'],
                note: $args['note'] ?? '',
                reminder: $args['reminder'] ?? '',
                autoReminder: $args['auto_reminder'] ?? false,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
