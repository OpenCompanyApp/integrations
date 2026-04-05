<?php

namespace OpenCompany\Integrations\NocoDB\Tools;

use OpenCompany\Integrations\NocoDB\NocoDBService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all tables in a NocoDB base.
 */
class NocoDBListTables implements Tool
{
    /**
     * @param  NocoDBService  $service  The NocoDB API client
     */
    public function __construct(
        private NocoDBService $service,
    ) {}

    public function name(): string
    {
        return 'nocodb_list_tables';
    }

    public function description(): string
    {
        return 'List all tables in a NocoDB base.';
    }

    public function parameters(): array
    {
        return [
            'base_id' => ['type' => 'string', 'required' => true, 'description' => 'Base ID.'],
        ];
    }

    /**
     * List all tables in a base.
     *
     * @param  array<string, mixed>  $args  Tool arguments (base_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('NocoDB integration is not configured.');
            }

            $baseId = $args['base_id'] ?? '';

            if (empty($baseId)) {
                return ToolResult::error('base_id is required.');
            }

            $result = $this->service->listTables($baseId);

            return ToolResult::success([
                'tables' => $result['list'] ?? $result['tables'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
