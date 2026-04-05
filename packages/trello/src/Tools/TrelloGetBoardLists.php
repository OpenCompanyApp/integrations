<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get all lists on a Trello board.
 */
class TrelloGetBoardLists implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_get_board_lists';
    }

    public function description(): string
    {
        return 'Get all lists on a Trello board.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The board ID.'],
        ];
    }

    /**
     * Retrieve all lists belonging to a board.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id)
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

            $lists = $this->service->getBoardLists($id);

            return ToolResult::success($lists);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
