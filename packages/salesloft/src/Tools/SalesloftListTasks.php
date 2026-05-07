<?php

namespace OpenCompany\Integrations\Salesloft\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Salesloft tasks.
 */
class SalesloftListTasks extends AbstractSalesloftTool implements Tool
{
    public function name(): string
    {
        return 'salesloft_list_tasks';
    }

    public function description(): string
    {
        return 'List Salesloft tasks with pagination and filters.';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'description' => 'Items per page.'],
            'user_id' => ['type' => 'integer', 'description' => 'Filter by assigned user.'],
            'person_id' => ['type' => 'integer', 'description' => 'Filter by person.'],
            'due_on' => ['type' => 'string', 'description' => 'Filter by due date.'],
        ];
    }

    /**
     * List tasks.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listTasks($this->only($args, ['page', 'per_page', 'user_id', 'person_id', 'due_on'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
