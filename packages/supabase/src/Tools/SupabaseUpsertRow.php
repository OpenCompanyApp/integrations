<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upsert a row into a Supabase table — insert or merge on conflict.
 *
 * Sends a POST request with the Prefer: resolution=merge-duplicates header
 * and optionally specifies the conflict columns via the on_conflict query param.
 */
class SupabaseUpsertRow implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_upsert_row';
    }

    public function description(): string
    {
        return <<<'MD'
        Insert a row or update it on conflict (upsert). If a row with matching
        conflict columns already exists, it will be merged with the provided data.
        Specify on_conflict to define which columns determine uniqueness.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'data' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of column name → value pairs (e.g., {"id":1,"name":"Alice"}).'],
            'on_conflict' => ['type' => 'string', 'description' => 'Comma-separated column names that define the unique constraint (e.g., "email").'],
        ];
    }

    /**
     * Upsert a row with the given column values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, data, on_conflict)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $table = $args['table'] ?? '';
            $data = $args['data'] ?? '';

            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($data)) {
                return ToolResult::error('data is required.');
            }

            $dataArray = is_string($data) ? json_decode($data, true) : $data;

            if (! is_array($dataArray)) {
                return ToolResult::error('data must be a valid JSON object.');
            }

            $onConflict = $args['on_conflict'] ?? '';

            $result = $this->service->upsertRow($table, $dataArray, $onConflict);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
