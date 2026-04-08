<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List views for a NocoDB table.
 */
class NocoDBListViews implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_list_views';
    }

    public function description(): string
    {
        return 'List views for a NocoDB table.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'Table ID.'],
        ];
    }

    /**
     * List views for a table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NocoDB integration is not configured.');
            }

            $tableId = $args['table_id'] ?? '';

            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }

            $result = $this->service->listViews($tableId);

            return ToolResult::success([
                'views' => $result['list'] ?? $result['views'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
