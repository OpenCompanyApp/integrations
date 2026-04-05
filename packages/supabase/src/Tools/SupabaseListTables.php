<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\Integrations\Supabase\SupabaseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Discover available tables in the Supabase database via the OpenAPI spec.
 */
class SupabaseListTables implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase API client
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_list_tables';
    }

    public function description(): string
    {
        return <<<'MD'
        List available tables in the Supabase database by querying the PostgREST
        OpenAPI spec endpoint. Returns table names with their column definitions.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all available tables and their schemas.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $spec = $this->service->listTables();

            if (empty($spec)) {
                return ToolResult::success('No tables found or OpenAPI spec unavailable.');
            }

            // Extract table info from the OpenAPI spec paths
            $tables = [];
            $paths = $spec['paths'] ?? [];
            $definitions = $spec['definitions'] ?? [];

            foreach ($paths as $path => $methods) {
                // Paths like "/tablename" (without slashes other than leading)
                $trimmed = trim($path, '/');
                if ($trimmed !== '' && ! str_contains($trimmed, '/')) {
                    $tableInfo = [
                        'name' => $trimmed,
                    ];

                    // Try to extract columns from definitions
                    $defKey = $trimmed;
                    if (isset($definitions[$defKey]['properties'])) {
                        $columns = [];
                        foreach ($definitions[$defKey]['properties'] as $colName => $colDef) {
                            $columns[$colName] = $colDef['type'] ?? $colDef['format'] ?? 'unknown';
                        }
                        $tableInfo['columns'] = $columns;
                    }

                    $tables[] = $tableInfo;
                }
            }

            if (empty($tables)) {
                // Fallback: return raw spec if parsing didn't yield tables
                return ToolResult::success($spec);
            }

            return ToolResult::success([
                'count' => count($tables),
                'tables' => $tables,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
