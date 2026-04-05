<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Insert multiple rows into a Supabase table in a single batch request.
 *
 * Sends a POST request with an array of row objects. Optionally performs
 * an upsert (merge on conflict) for all rows in the batch.
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
        Provide a JSON array of row objects. Optionally enable upsert to merge
        on conflict instead of failing.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'records' => ['type' => 'string', 'required' => true, 'description' => 'JSON array of row objects (e.g., [{"name":"Alice"},{"name":"Bob"}]).'],
            'upsert' => ['type' => 'boolean', 'description' => 'Whether to upsert (merge on conflict) instead of inserting. Default false.'],
        ];
    }

    /**
     * Insert multiple rows in a batch request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, records, upsert)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $table = $args['table'] ?? '';
            $records = $args['records'] ?? '';

            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($records)) {
                return ToolResult::error('records is required.');
            }

            $recordsArray = is_string($records) ? json_decode($records, true) : $records;

            if (! is_array($recordsArray)) {
                return ToolResult::error('records must be a valid JSON array.');
            }

            $upsert = ! empty($args['upsert']) && filter_var($args['upsert'], FILTER_VALIDATE_BOOLEAN);

            $result = $this->service->insertBatch($table, $recordsArray, 'representation', $upsert);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
