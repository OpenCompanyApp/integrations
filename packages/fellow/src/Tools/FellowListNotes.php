<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Fellow notes with optional filters and pagination.
 */
class FellowListNotes extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_list_notes';
    }

    public function description(): string
    {
        return 'List Fellow notes with optional filters, includes, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'description' => 'Raw Fellow list body with pagination, include, and filters.'],
            'pagination' => ['type' => 'object', 'description' => 'Pagination object.'],
            'include' => ['type' => 'object', 'description' => 'Optional expensive fields to include.'],
            'filters' => ['type' => 'object', 'description' => 'Note filters.'],
        ];
    }

    /**
     * Execute the list notes tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listNotes($this->body($args, [
            'pagination',
            'include',
            'filters',
        ])));
    }
}
