<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Monday.com item.
 *
 * Retrieves an item by ID including its name, column values, and group.
 */
class MondayGetItem implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_get_item';
    }

    public function description(): string
    {
        return 'Get detailed information about a Monday.com item.';
    }

    public function parameters(): array
    {
        return [
            'item_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the item to retrieve.'],
        ];
    }

    /**
     * Retrieve a single item by its ID.
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

            $query = <<<GRAPHQL
            query {
                items (ids: [{$itemId}]) {
                    id
                    name
                    state
                    group { id title }
                    column_values { id text value type }
                    board { id name }
                }
            }
            GRAPHQL;

            $result = $this->service->graphql($query);

            $items = $result['items'] ?? [];

            if (empty($items)) {
                return ToolResult::error("Item with ID {$itemId} not found.");
            }

            return ToolResult::success($items[0]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
