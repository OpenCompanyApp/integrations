<?php

namespace OpenCompany\Integrations\Dgraph\Tools;

use OpenCompany\Integrations\Dgraph\DgraphService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the schema for a specific GraphQL type.
 */
class DgraphGetSchema implements Tool
{
    /**
     * @param  DgraphService  $service  The Dgraph API client
     */
    public function __construct(
        private DgraphService $service,
    ) {}

    public function name(): string
    {
        return 'dgraph_get_schema';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the GraphQL schema for a specific type in Dgraph. Returns the type definition
        including all fields and their types. Provide the type name to inspect.
        MD;
    }

    public function parameters(): array
    {
        return [
            'type_name' => ['type' => 'string', 'required' => true, 'description' => 'The GraphQL type name to retrieve the schema for.'],
        ];
    }

    /**
     * Get the schema for a specific type.
     *
     * @param  array<string, mixed>  $args  Tool arguments (type_name)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Dgraph integration is not configured.');
            }

            $typeName = $args['type_name'] ?? '';
            if (empty($typeName)) {
                return ToolResult::error('type_name is required.');
            }

            $result = $this->service->getSchema($typeName);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
