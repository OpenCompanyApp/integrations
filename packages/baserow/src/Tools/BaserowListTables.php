<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all tables in a Baserow database (application).
 */
class BaserowListTables implements Tool
{
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_list_tables';
    }

    public function description(): string
    {
        return 'List all tables in a Baserow database (application).';
    }

    public function parameters(): array
    {
        return [
            'database_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow database (application) ID.'],
        ];
    }

    /**
     * Execute the list tables tool.
     *
     * @param  array<string, mixed> $args Tool arguments
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Baserow integration is not configured.');
            }

            $databaseId = $args['database_id'] ?? null;
            if (empty($databaseId)) {
                return ToolResult::error('database_id is required.');
            }

            $result = $this->service->listTables((int) $databaseId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
