<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new item on a Monday.com board.
 *
 * Uses the `create_item` mutation to add an item to a specific board
 * and group, optionally setting column values.
 */
class MondayCreateItem implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_create_item';
    }

    public function description(): string
    {
        return 'Create a new item on a Monday.com board.';
    }

    public function parameters(): array
    {
        return [
            'board_id'       => ['type' => 'integer', 'required' => true,  'description' => 'The ID of the board to create the item on.'],
            'group_id'       => ['type' => 'string',  'description' => 'The ID of the group to create the item in.'],
            'item_name'      => ['type' => 'string',  'required' => true,  'description' => 'The name of the new item.'],
            'column_values'  => ['type' => 'object',  'description' => 'A JSON object of column values to set, keyed by column ID.'],
        ];
    }

    /**
     * Create a new item on the specified board.
     *
     * @param  array<string, mixed>  $args  Tool arguments (board_id, group_id, item_name, column_values)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $boardId = $args['board_id'] ?? null;
            $itemName = $args['item_name'] ?? '';

            if (empty($boardId)) {
                return ToolResult::error('board_id is required.');
            }

            if (empty($itemName)) {
                return ToolResult::error('item_name is required.');
            }

            $groupId = $args['group_id'] ?? null;
            $columnValues = $args['column_values'] ?? null;

            $params = "board_id: {$boardId}, item_name: \"{$this->escapeGraphQL($itemName)}\"";

            if ($groupId !== null) {
                $params .= ", group_id: \"{$this->escapeGraphQL($groupId)}\"";
            }

            if ($columnValues !== null) {
                $json = $this->escapeGraphQL(json_encode($columnValues));
                $params .= ", column_values: \"{$json}\"";
            }

            $query = "mutation { create_item ({$params}) { id name } }";

            $result = $this->service->graphql($query);

            return ToolResult::success($result['create_item'] ?? []);
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
