<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all cards in a Trello list.
 */
class TrelloListCards implements Tool
{
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_list_cards';
    }

    public function description(): string
    {
        return 'List all cards in a Trello list. Supports limit and before cursor for pagination.';
    }

    public function parameters(): array
    {
        return [
            'list_id' => ['type' => 'string', 'required' => true, 'description' => 'The list ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Max number of cards to return (1–1000).'],
            'before' => ['type' => 'string', 'description' => 'Card ID to fetch cards before (for pagination).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $listId = $args['list_id'] ?? '';

            if (empty($listId)) {
                return ToolResult::error('List ID is required.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['before'])) {
                $params['before'] = $args['before'];
            }

            $cards = $this->service->listCards((string) $listId, $params);

            return ToolResult::success($cards);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
