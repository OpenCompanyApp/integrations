<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List records from a NocoDB table.
 *
 * Supports filtering by where clause, sorting, field selection,
 * view-based filtering, and offset-based pagination.
 */
class NocoDBListRecords implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_list_records';
    }

    public function description(): string
    {
        return 'List records from a NocoDB table with optional filtering, sorting, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'string', 'required' => true, 'description' => 'Table ID.'],
            'view_id'  => ['type' => 'string', 'description' => 'View ID to filter records by the view\'s filters.'],
            'limit'    => ['type' => 'integer', 'description' => 'Maximum number of records to return (default 25).'],
            'offset'   => ['type' => 'integer', 'description' => 'Pagination offset for skipping records.'],
            'where'    => ['type' => 'string', 'description' => 'NocoDB where clause for filtering (e.g., "(Status,eq,Done)").'],
            'sort'     => ['type' => 'string', 'description' => 'JSON array of sort objects, e.g. [{"field":"Name","direction":"asc"}].'],
            'fields'   => ['type' => 'string', 'description' => 'Comma-separated list of field names to return.'],
        ];
    }

    /**
     * List records from a table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table_id, view_id, limit, offset, where, sort, fields)
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

            if (! empty($args['view_id'])) {
                $params['viewId'] = $args['view_id'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (! empty($args['where'])) {
                $params['where'] = $args['where'];
            }
            if (! empty($args['sort'])) {
                $sort = $args['sort'];
                $params['sort'] = is_string($sort) ? json_decode($sort, true) : $sort;
            }
            if (! empty($args['fields'])) {
                $fields = $args['fields'];
                $params['fields'] = is_string($fields) ? array_map('trim', explode(',', $fields)) : $fields;
            }

            $result = $this->service->listRecords($tableId, $params);

            return ToolResult::success([
                'records' => $result['list'] ?? $result['records'] ?? [],
                'pageInfo' => $result['pageInfo'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
