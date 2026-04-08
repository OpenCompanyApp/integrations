<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Count records in a NocoDB table with optional filtering.
 */
class NocoDBCountRecords implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_count_records';
    }

    public function description(): string
    {
        return 'Count records in a NocoDB table with optional filtering.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'Table ID.'],
            'where'    => ['type' => 'string', 'description' => 'NocoDB where clause for filtering (e.g., "(Status,eq,Done)").'],
        ];
    }

    /**
     * Count records in a table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table_id, where)
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

            $params = [];

            if (! empty($args['where'])) {
                $params['where'] = $args['where'];
            }

            $result = $this->service->countRecords($tableId, $params);

            return ToolResult::success([
                'count' => $result['count'] ?? $result ?? 0,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
