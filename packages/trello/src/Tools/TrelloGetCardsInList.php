<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all cards in a Trello list with ID-based pagination.
 */
class TrelloGetCardsInList implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_get_cards_in_list';
    }

    public function description(): string
    {
        return 'List all cards in a Trello list.';
    }

    public function parameters(): array
    {
        return [
            'id'     => ['type' => 'integer', 'required' => true,  'description' => 'The list ID.'],
            'limit'  => ['type' => 'integer', 'description' => 'Max number of cards to return (1–1000, default varies).'],
            'before' => ['type' => 'string',  'description' => 'Card ID to fetch cards before (for pagination).'],
        ];
    }

    /**
     * Retrieve cards in a list, optionally paginated.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, limit, before)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['before'])) {
                $params['before'] = $args['before'];
            }

            $cards = $this->service->getCardsInList((string) $id, $params);

            return ToolResult::success($cards);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
