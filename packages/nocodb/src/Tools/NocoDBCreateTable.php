<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new table in a NocoDB base.
 */
class NocoDBCreateTable implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_create_table';
    }

    public function description(): string
    {
        return 'Create a new table in a NocoDB base.';
    }

    public function parameters(): array
    {
        return [
            'base_id'    => ['type' => 'string', 'required' => true, 'description' => 'Base ID.'],
            'table_name' => ['type' => 'string', 'required' => true, 'description' => 'Name for the new table.'],
            'columns'    => ['type' => 'string', 'required' => true, 'description' => 'JSON array of column definitions (e.g., [{"column_name":"Name","uidt":"SingleLineText"},{"column_name":"Age","uidt":"Number"}]).'],
        ];
    }

    /**
     * Create a new table with the specified columns.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id, table_name, columns)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NocoDB integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';
            $tableName = $args['table_name'] ?? '';
            $columns = $args['columns'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }
            if (empty($tableName)) {
                return ToolResult::error('table_name is required.');
            }
            if (empty($columns)) {
                return ToolResult::error('columns is required.');
            }

            $columnsArray = is_string($columns) ? json_decode($columns, true) : $columns;

            if (! is_array($columnsArray)) {
                return ToolResult::error('columns must be a valid JSON array.');
            }

            $result = $this->service->createTable($baseId, $tableName, $columnsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
