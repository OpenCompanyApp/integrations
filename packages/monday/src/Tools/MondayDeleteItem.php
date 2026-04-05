<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete an item from a Monday.com board.
 *
 * Uses the `delete_item` mutation to permanently remove an item.
 */
class MondayDeleteItem implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_delete_item';
    }

    public function description(): string
    {
        return 'Delete an item from a Monday.com board.';
    }

    public function parameters(): array
    {
        return [
            'item_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the item to delete.'],
        ];
    }

    /**
     * Permanently delete an item by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (item_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $itemId = $args['item_id'] ?? null;

            if (empty($itemId)) {
                return ToolResult::error('item_id is required.');
            }

            $query = "mutation { delete_item (item_id: {$itemId}) { id } }";

            $result = $this->service->graphql($query);

            return ToolResult::success($result['delete_item'] ?? []);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
