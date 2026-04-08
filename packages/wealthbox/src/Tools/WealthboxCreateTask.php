<?php

namespace OpenCompany\Integrations\Wealthbox\Tools;

use OpenCompany\Integrations\Wealthbox\WealthboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WealthboxCreateTask implements Tool
{
    /**
     * Create a new WealthboxCreateTask tool instance.
     */
    public function __construct(
        private WealthboxService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wealthbox_create_task';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new task in Wealthbox CRM. Provide a task name and optionally a due date, description, and assignee.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The task name or title.'],
            'due_date' => ['type' => 'string', 'description' => 'Due date in ISO 8601 format (e.g., "2026-04-15").'],
            'description' => ['type' => 'string', 'description' => 'Task description or notes.'],
            'assignee_id' => ['type' => 'integer', 'description' => 'User ID of the assignee.'],
            'contact_id' => ['type' => 'integer', 'description' => 'Link the task to a contact by their ID.'],
            'priority' => ['type' => 'string', 'description' => 'Task priority (e.g., "high", "medium", "low").'],
        ];
    }

    /**
     * Execute the create task tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wealthbox integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('A task name is required.');
            }

            $data = array_filter([
                'name' => $args['name'],
                'due_date' => $args['due_date'] ?? null,
                'description' => $args['description'] ?? null,
                'assignee_id' => $args['assignee_id'] ?? null,
                'contact_id' => $args['contact_id'] ?? null,
                'priority' => $args['priority'] ?? null,
            ], fn ($value) => $value !== null);

            $result = $this->service->createTask($data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
