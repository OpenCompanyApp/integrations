<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new item on a Monday.com board.
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
        return <<<'MD'
        Create a new item on a Monday.com board. Requires a board ID and item name.
        Optionally set a group and initial column values. Use monday_get_board to
        discover group IDs and column IDs.
        MD;
    }

    public function parameters(): array
    {
        return [
            'board_id' => ['type' => 'integer', 'required' => true, 'description' => 'Board ID to create the item on.'],
            'item_name' => ['type' => 'string', 'required' => true, 'description' => 'Name of the new item.'],
            'group_id' => ['type' => 'string', 'description' => 'Group ID to place the item in.'],
            'column_values' => ['type' => 'object', 'description' => 'Column values to set, keyed by column ID. Values depend on column type.'],
        ];
    }

    /**
     * Create a new Monday.com item.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $boardId = $args['board_id'] ?? '';
            $itemName = $args['item_name'] ?? '';

            if (empty($boardId)) {
                return ToolResult::error('board_id is required.');
            }
            if (empty($itemName)) {
                return ToolResult::error('item_name is required.');
            }

            $groupId = $args['group_id'] ?? null;
            $columnValues = $args['column_values'] ?? null;

            if (is_string($columnValues)) {
                $columnValues = json_decode($columnValues, true) ?? null;
            }

            $result = $this->service->createItem((int) $boardId, $itemName, $groupId, $columnValues);
            $item = $result['data']['create_item'] ?? null;

            if ($item === null) {
                return ToolResult::error('Failed to create item. The API returned no item data.');
            }

            return ToolResult::success([
                'id' => $item['id'] ?? '',
                'name' => $item['name'] ?? '',
                'state' => $item['state'] ?? '',
                'board' => isset($item['board']) ? [
                    'id' => $item['board']['id'] ?? '',
                    'name' => $item['board']['name'] ?? '',
                ] : null,
                'group' => isset($item['group']) ? [
                    'id' => $item['group']['id'] ?? '',
                    'title' => $item['group']['title'] ?? '',
                ] : null,
                'created_at' => $item['created_at'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
