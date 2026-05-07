<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List rows in a Baserow table with optional filtering, searching, and pagination.
 */
class BaserowListRows implements Tool
{
    /**
     * @param  BaserowService  $service  The Baserow API client.
     */
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_list_rows';
    }

    public function description(): string
    {
        return 'List rows in a Baserow table with optional filtering, searching, sorting, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'table_id'    => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'limit'       => ['type' => 'integer', 'description' => 'Maximum number of rows to return (default: 100).'],
            'offset'      => ['type' => 'integer', 'description' => 'Number of rows to skip for pagination.'],
            'search'      => ['type' => 'string', 'description' => 'Search term to filter rows by.'],
            'order_by'    => ['type' => 'string', 'description' => 'Field name to order by. Prefix with "-" for descending.'],
            'filter_type' => ['type' => 'string', 'description' => 'How to combine filters: "AND" or "OR".'],
            'filters'     => ['type' => 'string', 'description' => 'JSON array of filter objects, e.g. [{"field": 123, "type": "equal", "value": "test"}].'],
            'field_ids'   => ['type' => 'string', 'description' => 'Comma-separated list of field IDs to include in the response.'],
        ];
    }

    /**
     * Execute the list rows tool.
     *
     * @param  array<string, mixed> $args Tool arguments
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Baserow integration is not configured.');
            }

            $tableId = $args['table_id'] ?? null;
            if (empty($tableId)) {
                return ToolResult::error('table_id is required.');
            }

            $params = [];
            if (isset($args['limit']))       { $params['limit']       = (int) $args['limit']; }
            if (isset($args['offset']))      { $params['offset']      = (int) $args['offset']; }
            if (isset($args['search']))      { $params['search']      = $args['search']; }
            if (isset($args['order_by']))    { $params['order_by']    = $args['order_by']; }
            if (isset($args['filter_type'])) { $params['filter_type'] = $args['filter_type']; }
            if (isset($args['filters'])) {
                $params['filters'] = is_string($args['filters'])
                    ? json_decode($args['filters'], true)
                    : $args['filters'];
            }
            if (isset($args['field_ids'])) { $params['field_ids'] = $args['field_ids']; }

            $result = $this->service->listRows((int) $tableId, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
