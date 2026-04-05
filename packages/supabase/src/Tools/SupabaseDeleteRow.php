<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a row from a Supabase table by its primary key id.
 *
 * Sends a DELETE request and optionally returns the deleted row
 * when Prefer: return=representation is used.
 */
class SupabaseDeleteRow implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_delete_row';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete a row from a Supabase table by its primary key id.
        The deleted row data is returned by default.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Primary key value of the row to delete.'],
        ];
    }

    /**
     * Delete a row by its primary key.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, id)
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

            $result = $this->service->deleteRow($table, $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
