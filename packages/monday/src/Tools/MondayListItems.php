<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List items on a Monday.com board.
 *
 * Uses the `items_page` query on boards to retrieve items with
 * optional pagination and filtering.
 */
class MondayListItems implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_list_items';
    }

    public function description(): string
    {
        return 'List items on a Monday.com board with optional filtering.';
    }

    public function parameters(): array
    {
        return [
            'board_id' => ['type' => 'integer', 'required' => true,  'description' => 'The ID of the board to list items from.'],
            'limit'    => ['type' => 'integer', 'description' => 'Maximum number of items to return (default 25, max 500).'],
            'page'     => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1).'],
            'query'    => ['type' => 'string',  'description' => 'Search query to filter items by name.'],
        ];
    }

    /**
     * Retrieve a paginated list of items from a board.
     *
     * @param  array<string, mixed>  $args  Tool arguments (board_id, limit, page, query)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $boardId = $args['board_id'] ?? null;

            if (empty($boardId)) {
                return ToolResult::error('board_id is required.');
            }

            $limit = $args['limit'] ?? 25;
            $page = $args['page'] ?? 1;

            $params = "limit: {$limit}";

            if (isset($args['query']) && ! empty($args['query'])) {
                $escapedQuery = $this->escapeGraphQL($args['query']);
                $params .= ", query_params: { rules: [{ column_id: \"name\", compare_value: \"{$escapedQuery}\", operator: any_of }] }";
            }

            $query = <<<GRAPHQL
            query {
                boards (ids: [{$boardId}]) {
                    items_page ({$params}) {
                        cursor
                        items {
                            id
                            name
                            state
                            group { id title }
                            column_values { id text value type }
                        }
                    }
                }
            }
            GRAPHQL;

            $result = $this->service->graphql($query);

            $boards = $result['boards'] ?? [];
            $itemsPage = $boards[0]['items_page'] ?? [];

            return ToolResult::success($itemsPage);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Escape a string for safe embedding in a GraphQL query.
     *
     * @param  string  $value  The raw string value
     * @return string  The escaped string
     */
    private function escapeGraphQL(string $value): string
    {
        return str_replace(
            ['\\', '"', "\n", "\r", "\t"],
            ['\\\\', '\\"', '\\n', '\\r', '\\t'],
            $value,
        );
    }
}
