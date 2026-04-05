<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Trello board.
 */
class TrelloGetBoard implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_get_board';
    }

    public function description(): string
    {
        return 'Get detailed information about a Trello board.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The board ID.'],
        ];
    }

    /**
     * Retrieve a board by its ID.
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

            $board = $this->service->getBoard($id);

            return ToolResult::success($board);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
