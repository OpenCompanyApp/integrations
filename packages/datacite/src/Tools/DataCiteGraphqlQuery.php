<?php

namespace OpenCompany\Integrations\DataCite\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\DataCite\DataCiteService;

/**
 * Execute a DataCite GraphQL query.
 */
class DataCiteGraphqlQuery implements Tool
{
    /**
     * @param  DataCiteService  $service  DataCite API client.
     */
    public function __construct(private DataCiteService $service) {}

    public function name(): string
    {
        return 'datacite_graphql_query';
    }

    public function description(): string
    {
        return 'Execute a read-only DataCite GraphQL query.';
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'GraphQL query string.'],
            'variables' => ['type' => 'object', 'required' => false, 'description' => 'GraphQL variables.'],
        ];
    }

    /**
     * Execute a DataCite GraphQL query.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $query = (string) ($args['query'] ?? '');
            if ($query === '') {
                throw new InvalidArgumentException('query is required.');
            }

            $variables = isset($args['variables']) && is_array($args['variables']) ? $args['variables'] : [];

            return ToolResult::success($this->service->graphql($query, $variables));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
