<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Insert a single row into a Supabase table.
 */
class SupabaseInsertRow implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_insert_row';
    }

    public function description(): string
    {
        return <<<'MD'
        Insert a single row into a Supabase table. Provide column values as a JSON object.
        Optionally enable upsert mode to merge duplicates on conflict.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'data' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of column name → value pairs.'],
            'returning' => ['type' => 'string', 'description' => 'Return mode: "representation" (default) or "minimal".'],
            'upsert' => ['type' => 'boolean', 'description' => 'Set to true to merge duplicates on conflict.'],
        ];
    }

    /**
     * Insert a row into the specified table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, data, returning, upsert)
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

            $returning = $args['returning'] ?? 'representation';
            $upsert = ($args['upsert'] ?? false) === true || $args['upsert'] === 'true';

            $result = $this->service->insertRow($table, $data, $returning, $upsert);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
