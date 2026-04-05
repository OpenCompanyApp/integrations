<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upsert a row into a Supabase table — insert or merge on conflict.
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
        Upsert a row into a Supabase table. If a row with the same unique key exists,
        it will be merged (updated); otherwise a new row is inserted.
        Specify the on_conflict columns to define the unique constraint.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'data' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of column name → value pairs.'],
            'on_conflict' => ['type' => 'string', 'description' => 'Comma-separated column names that define the unique constraint (e.g., "email,id").'],
            'returning' => ['type' => 'string', 'description' => 'Return mode: "representation" (default) or "minimal".'],
        ];
    }

    /**
     * Upsert a row — insert or update on conflict.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, data, on_conflict, returning)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $table = $args['table'] ?? '';
            if (empty($table)) {
                return ToolResult::error('table is required.');
            }

            $rawData = $args['data'] ?? '';
            if (empty($rawData)) {
                return ToolResult::error('data is required.');
            }

            if (is_string($rawData)) {
                $data = json_decode($rawData, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return ToolResult::error('Invalid JSON in data: ' . json_last_error_msg());
                }
            } else {
                $data = $rawData;
            }

            $onConflict = $args['on_conflict'] ?? '';
            $returning = $args['returning'] ?? 'representation';

            $result = $this->service->upsertRow($table, $data, $onConflict, $returning);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
