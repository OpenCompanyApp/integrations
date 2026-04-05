<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Insert multiple rows into a Supabase table in a single batch request.
 */
class SupabaseInsertBatch implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_insert_batch';
    }

    public function description(): string
    {
        return <<<'MD'
        Insert multiple rows into a Supabase table in a single batch request.
        Provide an array of row objects. Optionally enable upsert mode to merge duplicates.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'records' => ['type' => 'string', 'required' => true, 'description' => 'JSON array of row objects, each containing column name → value pairs.'],
            'returning' => ['type' => 'string', 'description' => 'Return mode: "representation" (default) or "minimal".'],
            'upsert' => ['type' => 'boolean', 'description' => 'Set to true to merge duplicates on conflict.'],
        ];
    }

    /**
     * Insert multiple rows as a batch into the specified table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, records, returning, upsert)
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

            $rawRecords = $args['records'] ?? '';
            if (empty($rawRecords)) {
                return ToolResult::error('records is required.');
            }

            if (is_string($rawRecords)) {
                $records = json_decode($rawRecords, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return ToolResult::error('Invalid JSON in records: ' . json_last_error_msg());
                }
            } else {
                $records = $rawRecords;
            }

            if (! is_array($records) || ! array_is_list($records)) {
                return ToolResult::error('records must be a JSON array of row objects.');
            }

            $returning = $args['returning'] ?? 'representation';
            $upsert = ($args['upsert'] ?? false) === true || $args['upsert'] === 'true';

            $result = $this->service->insertBatch($table, $records, $returning, $upsert);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
