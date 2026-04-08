<?php

namespace OpenCompany\Integrations\Weaviate\Tools;

use OpenCompany\Integrations\Weaviate\WeaviateService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WeaviateSearchObjects implements Tool
{
    /**
     * Create a new WeaviateSearchObjects tool instance.
     */
    public function __construct(
        private WeaviateService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'weaviate_search_objects';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Search and query objects in Weaviate using GraphQL. Supports Get, Aggregate, and Explore queries with filters, sorting, and vector/nearVector/nearText search.';
    }

    /**
     * Get the tool parameters definition.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'The GraphQL query string to execute against the Weaviate GraphQL endpoint. E.g.: { Get { Article { title content } } }'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Weaviate integration is not configured.');
            }

            $query = $args['query'] ?? '';

            if (empty($query)) {
                return ToolResult::error('query is required.');
            }

            $result = $this->service->graphql($query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
