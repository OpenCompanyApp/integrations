<?php

namespace OpenCompany\Integrations\Convex\Tools;

use OpenCompany\Integrations\Convex\ConvexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get metadata and schema for a specific Convex table.
 */
class ConvexGetTable implements Tool
{
    /**
     * @param  ConvexService  $service  The Convex API client
     */
    public function __construct(
        private ConvexService $service,
    ) {}

    public function name(): string
    {
        return 'convex_get_table';
    }

    public function description(): string
    {
        return 'Get metadata and schema for a specific Convex table.';
    }

    public function parameters(): array
    {
        return [
            'table' => ['type' => 'string', 'required' => true, 'description' => 'Table name or ID.'],
        ];
    }

    /**
     * Get a table's metadata and schema.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Convex integration is not configured.');
            }

            $table = $args['table'] ?? '';

            if (empty($table)) {
                return ToolResult::error('table is required.');
            }

            $result = $this->service->getTable($table);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
