<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\Integrations\Baserow\BaserowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Baserow databases (applications) accessible to the token.
 */
class BaserowListDatabases implements Tool
{
    public function __construct(
        private BaserowService $service,
    ) {}

    public function name(): string
    {
        return 'baserow_list_databases';
    }

    public function description(): string
    {
        return 'List all Baserow databases (applications) accessible to the current token.';
    }

    public function parameters(): array
    {
        return [
            'type' => ['type' => 'string', 'description' => 'Filter by application type, e.g. "database".'],
        ];
    }

    /**
     * Execute the list databases tool.
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

            $type  = $args['type'] ?? null;
            $result = $this->service->listDatabases($type);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
