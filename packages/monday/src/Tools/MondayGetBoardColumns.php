<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the column structure of a Monday.com board.
 *
 * Retrieves all columns (their IDs, titles, and types) for a given board,
 * useful for understanding what column values to set when creating or
 * updating items.
 */
class MondayGetBoardColumns implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_get_board_columns';
    }

    public function description(): string
    {
        return 'Get the column structure of a Monday.com board.';
    }

    public function parameters(): array
    {
        return [
            'board_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the board to get columns for.'],
        ];
    }

    /**
     * Retrieve all columns for a board.
     *
     * @param  array<string, mixed>  $args  Tool arguments (board_id)
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

            $query = <<<GRAPHQL
            query {
                boards (ids: [{$boardId}]) {
                    columns {
                        id
                        title
                        type
                        settings_str
                    }
                }
            }
            GRAPHQL;

            $result = $this->service->graphql($query);

            $boards = $result['boards'] ?? [];

            if (empty($boards)) {
                return ToolResult::error("Board with ID {$boardId} not found.");
            }

            return ToolResult::success($boards[0]['columns'] ?? []);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
