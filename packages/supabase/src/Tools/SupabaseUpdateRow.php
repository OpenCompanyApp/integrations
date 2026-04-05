<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing row in a Supabase table by its primary key id.
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
        Provide the columns to update as a JSON object.
        MD;
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Primary key value of the row to update.'],
            'data' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of column name → value pairs to update.'],
            'returning' => ['type' => 'string', 'description' => 'Return mode: "representation" (default) or "minimal".'],
        ];
    }

    /**
     * Update a row identified by its primary key.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, id, data, returning)
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

            $result = $this->service->updateRow($table, $id, $data, $returning);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
