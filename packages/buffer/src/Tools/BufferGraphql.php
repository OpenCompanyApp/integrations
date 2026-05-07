<?php

namespace OpenCompany\Integrations\Buffer\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a Buffer GraphQL API operation.
 */
class BufferGraphql extends AbstractBufferTool
{
    public function name(): string
    {
        return 'buffer_graphql';
    }

    public function description(): string
    {
        return 'Execute a Buffer GraphQL API operation against the current beta API endpoint.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'GraphQL query or mutation document.'],
            'variables' => ['type' => 'object', 'description' => 'GraphQL variables.'],
            'operationName' => ['type' => 'string', 'description' => 'Optional GraphQL operation name.'],
        ];
    }

    /**
     * Execute the GraphQL operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buffer integration is not configured.');
            }

            if (empty($args['query'])) {
                return ToolResult::error('query is required.');
            }

            return ToolResult::success($this->service->graphql(
                $args['query'],
                $args['variables'] ?? [],
                $args['operationName'] ?? null,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
