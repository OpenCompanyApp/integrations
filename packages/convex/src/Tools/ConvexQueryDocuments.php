<?php

namespace OpenCompany\Integrations\Convex\Tools;

use OpenCompany\Integrations\Convex\ConvexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Query documents from a Convex table with optional filtering and pagination.
 */
class ConvexQueryDocuments implements Tool
{
    /**
     * @param  ConvexService  $service  The Convex API client
     */
    public function __construct(
        private ConvexService $service,
    ) {}

    public function name(): string
    {
        return 'convex_query_documents';
    }

    public function description(): string
    {
        return 'Query documents from a Convex table with optional filtering and pagination.';
    }

    public function parameters(): array
    {
        return [
            'table'   => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'filter'  => ['type' => 'string', 'description' => 'JSON object of field name → value pairs to filter documents by.'],
            'order'   => ['type' => 'string', 'description' => 'Field name to order results by. Prefix with "-" for descending (e.g., "-createdAt").'],
            'limit'   => ['type' => 'integer', 'description' => 'Maximum number of documents to return.'],
            'cursor'  => ['type' => 'string', 'description' => 'Pagination cursor from a previous response.'],
        ];
    }

    /**
     * Query documents from a table.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, filter, order, limit, cursor)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Convex integration is not configured.');
            }

            $table = $args['table'] ?? '';

            if (empty($table)) {
                return ToolResult::error('table is required.');
            }

            $params = [];

            if (! empty($args['filter'])) {
                $filter = $args['filter'];
                $params['filter'] = is_string($filter) ? json_decode($filter, true) : $filter;
            }
            if (! empty($args['order'])) {
                $params['order'] = $args['order'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (! empty($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            $result = $this->service->queryDocuments($table, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
