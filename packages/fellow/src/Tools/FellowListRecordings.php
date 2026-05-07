<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Fellow recordings with optional filters and pagination.
 */
class FellowListRecordings extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_list_recordings';
    }

    public function description(): string
    {
        return 'List Fellow recordings with optional filters, includes, pagination, and media URL settings.';
    }

    public function parameters(): array
    {
        return [
            'payload' => ['type' => 'object', 'description' => 'Raw Fellow list body with pagination, include, filters, and media_url.'],
            'pagination' => ['type' => 'object', 'description' => 'Pagination object.'],
            'include' => ['type' => 'object', 'description' => 'Optional expensive fields to include.'],
            'filters' => ['type' => 'object', 'description' => 'Recording filters.'],
            'media_url' => ['type' => 'object', 'description' => 'Media URL expiration configuration.'],
        ];
    }

    /**
     * Execute the list recordings tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listRecordings($this->body($args, [
            'pagination',
            'include',
            'filters',
            'media_url',
        ])));
    }
}
