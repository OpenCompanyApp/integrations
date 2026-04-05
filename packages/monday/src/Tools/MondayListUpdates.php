<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List updates (comments) on a Monday.com item.
 *
 * Retrieves the update history for an item, including body text
 * and author information.
 */
class MondayListUpdates implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_list_updates';
    }

    public function description(): string
    {
        return 'List updates (comments) on a Monday.com item.';
    }

    public function parameters(): array
    {
        return [
            'item_id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the item to list updates for.'],
            'limit'   => ['type' => 'integer', 'description' => 'Maximum number of updates to return (default 25).'],
            'page'    => ['type' => 'integer', 'description' => 'Page number for pagination (starts at 1).'],
        ];
    }

    /**
     * Retrieve a paginated list of updates for an item.
     *
     * @param  array<string, mixed>  $args  Tool arguments (item_id, limit, page)
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

            $limit = $args['limit'] ?? 25;
            $page = $args['page'] ?? 1;

            $query = <<<GRAPHQL
            query {
                items (ids: [{$itemId}]) {
                    updates (limit: {$limit}, page: {$page}) {
                        id
                        body
                        created_at
                        creator { id name email }
                    }
                }
            }
            GRAPHQL;

            $result = $this->service->graphql($query);

            $items = $result['items'] ?? [];

            if (empty($items)) {
                return ToolResult::error("Item with ID {$itemId} not found.");
            }

            return ToolResult::success($items[0]['updates'] ?? []);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
