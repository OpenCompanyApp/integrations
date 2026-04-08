<?php

namespace OpenCompany\Integrations\Dgraph\Tools;

use OpenCompany\Integrations\Dgraph\DgraphService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all indexes defined in the Dgraph schema.
 */
class DgraphListIndexes implements Tool
{
    /**
     * @param  DgraphService  $service  The Dgraph API client
     */
    public function __construct(
        private DgraphService $service,
    ) {}

    public function name(): string
    {
        return 'dgraph_list_indexes';
    }

    public function description(): string
    {
        return <<<'MD'
        List all indexes defined in the Dgraph schema. Returns types with their
        fields and directives, allowing you to identify indexed fields and their
        index types (hash, exact, term, fulltext, trigram, etc.).
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all indexes in the schema.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Dgraph integration is not configured.');
            }

            $result = $this->service->listIndexes();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
