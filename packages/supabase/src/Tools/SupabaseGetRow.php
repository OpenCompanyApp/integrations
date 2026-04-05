<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single row from a Supabase table by its primary key id.
 */
class SupabaseGetRow implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_get_row';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single row from a Supabase table by its primary key id.
        Optionally specify which columns to return using the select parameter.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Primary key value of the row.'],
            'select' => ['type' => 'string', 'description' => 'Comma-separated column names (default "*").'],
        ];
    }

    /**
     * Get a single row by its primary key.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, id, select)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $table = $args['table'] ?? '';
            $id = $args['id'] ?? '';

            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $select = $args['select'] ?? '*';

            $result = $this->service->getRow($table, $id, $select);

            if (empty($result)) {
                return ToolResult::error("Row with id {$id} not found in table {$table}.");
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
