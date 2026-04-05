<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Search for cards across Trello boards.
 */
class TrelloSearchCards implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_search_cards';
    }

    public function description(): string
    {
        return 'Search for cards across Trello boards.';
    }

    public function parameters(): array
    {
        return [
            'query'       => ['type' => 'string', 'required' => true,  'description' => 'Search query string.'],
            'id_boards'   => ['type' => 'string', 'description' => 'Comma-separated board IDs to search in (default: all).'],
            'model_types' => ['type' => 'string', 'description' => 'Comma-separated model types, e.g. "cards". Default: all.'],
            'limit'       => ['type' => 'integer','description' => 'Max results to return (1–100, default 10).'],
        ];
    }

    /**
     * Search Trello for cards matching a query.
     *
     * @param  array<string, mixed>  $args  Tool arguments (query, id_boards, model_types, limit)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $query = $args['query'] ?? '';

            if (empty($query)) {
                return ToolResult::error('query is required.');
            }

            $params = ['query' => $query];

            if (isset($args['id_boards'])) {
                $params['idBoards'] = $args['id_boards'];
            }
            if (isset($args['model_types'])) {
                $params['modelTypes'] = $args['model_types'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }

            $results = $this->service->searchCards($params);

            return ToolResult::success($results);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
