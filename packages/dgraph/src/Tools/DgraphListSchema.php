<?php

namespace OpenCompany\Integrations\Dgraph\Tools;

use OpenCompany\Integrations\Dgraph\DgraphService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List the full GraphQL schema with all types and fields.
 */
class DgraphListSchema implements Tool
{
    /**
     * @param  DgraphService  $service  The Dgraph API client
     */
    public function __construct(
        private DgraphService $service,
    ) {}

    public function name(): string
    {
        return 'dgraph_list_schema';
    }

    public function description(): string
    {
        return <<<'MD'
        List the full GraphQL schema from Dgraph. Returns all types, their fields,
        and field types. Useful for understanding the overall data model.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List the full GraphQL schema.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Dgraph integration is not configured.');
            }

            $result = $this->service->listSchema();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
