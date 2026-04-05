<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Move a Monday.com item to a different group.
 *
 * Uses the `move_item_to_group` mutation to transfer an item
 * from its current group to a target group on the same board.
 */
class MondayMoveItemToGroup implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_move_item_to_group';
    }

    public function description(): string
    {
        return 'Move a Monday.com item to a different group.';
    }

    public function parameters(): array
    {
        return [
            'item_id'  => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the item to move.'],
            'group_id' => ['type' => 'string',  'required' => true, 'description' => 'The ID of the target group.'],
        ];
    }

    /**
     * Move an item to the specified group.
     *
     * @param  array<string, mixed>  $args  Tool arguments (item_id, group_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $itemId = $args['item_id'] ?? null;
            $groupId = $args['group_id'] ?? '';

            if (empty($itemId)) {
                return ToolResult::error('item_id is required.');
            }

            if (empty($groupId)) {
                return ToolResult::error('group_id is required.');
            }

            $escapedGroupId = $this->escapeGraphQL($groupId);

            $query = "mutation { move_item_to_group (item_id: {$itemId}, group_id: \"{$escapedGroupId}\") { id name group { id title } } }";

            $result = $this->service->graphql($query);

            return ToolResult::success($result['move_item_to_group'] ?? []);
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
