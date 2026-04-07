<?php

namespace OpenCompany\Integrations\Dgraph\Tools;

use OpenCompany\Integrations\Dgraph\DgraphService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a custom GraphQL query against Dgraph.
 */
class DgraphQuery implements Tool
{
    /**
     * @param  DgraphService  $service  The Dgraph API client
     */
    public function __construct(
        private DgraphService $service,
    ) {}

    public function name(): string
    {
        return 'dgraph_query';
    }

    public function description(): string
    {
        return <<<'MD'
        Execute a custom GraphQL query against Dgraph. Provide the full GraphQL
        query string and optional variables. Supports all query operations including
        filtering, pagination, sorting, and nested traversals.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The GraphQL query string to execute.'],
            'variables' => ['type' => 'object', 'description' => 'Optional variables object for the query.'],
        ];
    }

    /**
     * Execute a custom GraphQL query.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, variables)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Dgraph integration is not configured.');
            }

            $query = $args['query'] ?? '';
            if (empty($query)) {
                return ToolResult::error('query is required.');
            }

            $variables = $args['variables'] ?? [];
            if (is_string($variables)) {
                $variables = json_decode($variables, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return ToolResult::error('Invalid JSON in variables: ' . json_last_error_msg());
                }
            }

            $result = $this->service->query($query, $variables ?? []);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
