<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Tally forms with pagination support.
 */
class TallyListForms extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_list_forms';
    }

    public function description(): string
    {
        return 'List all Tally forms accessible to the authenticated user. Returns form IDs, titles, status, and submission counts. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (default: 1).',
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of forms per page (default: 50, max: 500).',
            ],
            'workspace_ids' => [
                'type' => 'array',
                'description' => 'Optional workspace IDs to filter forms by.',
                'items' => ['type' => 'string'],
            ],
        ];
    }

    /**
     * Execute the list forms request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (page, limit).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listForms(
            array_merge(
                $this->params($args, ['page', 'limit']),
                $this->mappedPayload($args, ['workspace_ids' => 'workspaceIds']),
            ),
        ));
    }
}
