<?php

namespace OpenCompany\Integrations\Fauna\Tools;

use OpenCompany\Integrations\Fauna\FaunaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Execute a Fauna Query Language (FQL) expression.
 */
class FaunaQueryFql implements Tool
{
    /**
     * @param  FaunaService  $service  The Fauna API client
     */
    public function __construct(
        private FaunaService $service,
    ) {}

    public function name(): string
    {
        return 'fauna_query_fql';
    }

    public function description(): string
    {
        return <<<'MD'
        Execute a Fauna Query Language (FQL) expression. Provide the query as a JSON-encoded
        FQL expression. Supports all FQL operations including document reads, writes,
        indexes, and complex queries.
        MD;
    }

    public function parameters(): array
    {
        return [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'JSON-encoded FQL query expression.'],
        ];
    }

    /**
     * Execute an FQL query.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fauna integration is not configured.');
            }

            $rawQuery = $args['query'] ?? '';
            if (empty($rawQuery)) {
                return ToolResult::error('query is required.');
            }

            if (is_string($rawQuery)) {
                $query = json_decode($rawQuery, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return ToolResult::error('Invalid JSON in query: ' . json_last_error_msg());
                }
            } else {
                $query = $rawQuery;
            }

            $result = $this->service->queryFql($query);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
