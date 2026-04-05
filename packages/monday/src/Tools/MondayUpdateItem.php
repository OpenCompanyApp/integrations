<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update column values on an existing Monday.com item.
 *
 * Uses the `change_multiple_column_values` mutation to update one or
 * more columns on a given item within a board.
 */
class MondayUpdateItem implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_update_item';
    }

    public function description(): string
    {
        return 'Update column values on an existing Monday.com item.';
    }

    public function parameters(): array
    {
        return [
            'board_id'       => ['type' => 'integer', 'required' => true,  'description' => 'The ID of the board the item belongs to.'],
            'item_id'        => ['type' => 'integer', 'required' => true,  'description' => 'The ID of the item to update.'],
            'column_values'  => ['type' => 'object',  'required' => true,  'description' => 'A JSON object of column values to update, keyed by column ID.'],
        ];
    }

    /**
     * Update multiple column values on an item.
     *
     * @param  array<string, mixed>  $args  Tool arguments (board_id, item_id, column_values)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $boardId = $args['board_id'] ?? null;
            $itemId = $args['item_id'] ?? null;
            $columnValues = $args['column_values'] ?? null;

            if (empty($boardId)) {
                return ToolResult::error('board_id is required.');
            }

            if (empty($itemId)) {
                return ToolResult::error('item_id is required.');
            }

            if (empty($columnValues)) {
                return ToolResult::error('column_values is required.');
            }

            $json = $this->escapeGraphQL(json_encode($columnValues));

            $query = "mutation { change_multiple_column_values (board_id: {$boardId}, item_id: {$itemId}, column_values: \"{$json}\") { id name } }";

            $result = $this->service->graphql($query);

            return ToolResult::success($result['change_multiple_column_values'] ?? []);
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
