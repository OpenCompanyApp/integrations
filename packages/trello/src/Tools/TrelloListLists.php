<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all lists on a Trello board.
 */
class TrelloListLists implements Tool
{
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_list_lists';
    }

    public function description(): string
    {
        return 'List all lists on a Trello board.';
    }

    public function parameters(): array
    {
        return [
            'board_id' => ['type' => 'string', 'required' => true, 'description' => 'The board ID to list lists from.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $boardId = $args['board_id'] ?? '';

            if (empty($boardId)) {
                return ToolResult::error('Board ID is required.');
            }

            $lists = $this->service->listLists((string) $boardId);

            return ToolResult::success($lists);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
