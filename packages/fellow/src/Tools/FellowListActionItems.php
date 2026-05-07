<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list Fellow action items with pagination.
 */
class FellowListActionItems extends AbstractFellowTool implements Tool
{
    /**
     * Return the tool's machine name.
     */
    public function name(): string
    {
        return 'fellow_list_action_items';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List action items from Fellow. Supports cursor-based pagination and optional status filtering. Returns action item titles, assignees, due dates, and completion status.';
    }

    /**
     * Return the tool's parameter schema.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'description' => 'Raw Fellow list body with pagination, include, order_by, and filters.'],
            'pagination' => ['type' => 'object', 'description' => 'Pagination object.'],
            'include' => ['type' => 'string', 'description' => 'Optional include field.'],
            'order_by' => ['type' => 'string', 'description' => 'Order by created_at_desc, created_at_asc, or due_date.'],
            'filters' => ['type' => 'object', 'description' => 'Action item filters, including scope.'],
        ];
    }

    /**
     * Execute the tool with the given arguments.
     *
     * @param  array<string, mixed>  $args
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listActionItems($this->body($args, [
            'pagination',
            'include',
            'order_by',
            'filters',
        ])));
    }
}
