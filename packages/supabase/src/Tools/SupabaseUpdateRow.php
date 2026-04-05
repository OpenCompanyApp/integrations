<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing row in a Supabase table by its primary key id.
 *
 * Sends a PATCH request with the updated column values and returns the
 * updated row when returning is set to "representation".
 */
class SupabaseUpdateRow implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_update_row';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing row in a Supabase table by its primary key id.
        Provide the columns to update as a JSON object. By default, the
        updated row is returned.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Primary key value of the row to update.'],
            'data' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of column name → value pairs to update (e.g., {"name":"Jane"}).'],
        ];
    }

    /**
     * Update a row by its primary key with the given column values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, id, data)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $table = $args['table'] ?? '';
            $id = $args['id'] ?? '';
            $data = $args['data'] ?? '';

            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($id)) {
                return ToolResult::error('id is required.');
            }
            if (empty($data)) {
                return ToolResult::error('data is required.');
            }

            $dataArray = is_string($data) ? json_decode($data, true) : $data;

            if (! is_array($dataArray)) {
                return ToolResult::error('data must be a valid JSON object.');
            }

            $result = $this->service->updateRow($table, $id, $dataArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
