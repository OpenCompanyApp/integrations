<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Move a Trello card to a different list.
 */
class TrelloMoveCard implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_move_card';
    }

    public function description(): string
    {
        return 'Move a card to a different list.';
    }

    public function parameters(): array
    {
        return [
            'id'      => ['type' => 'string', 'required' => true, 'description' => 'The card ID to move.'],
            'id_list' => ['type' => 'string', 'required' => true, 'description' => 'The destination list ID.'],
        ];
    }

    /**
     * Move a card to a different list by updating its idList.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, id_list)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $id = $args['id'] ?? '';
            $idList = $args['id_list'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }
            if (empty($idList)) {
                return ToolResult::error('id_list is required.');
            }

            $card = $this->service->updateCard($id, ['idList' => $idList]);

            return ToolResult::success($card);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
