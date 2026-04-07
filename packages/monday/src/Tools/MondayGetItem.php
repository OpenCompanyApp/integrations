<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single Monday.com item by ID with its column values.
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
        return <<<'MD'
        Get a single Monday.com item by ID. Returns full item details
        including all column values, board info, group, and creator.
        MD;
    }

    public function parameters(): array
    {
        return [
            'item_id' => ['type' => 'integer', 'required' => true, 'description' => 'Item ID to retrieve.'],
        ];
    }

    /**
     * Fetch a single Monday.com item by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $itemId = $args['item_id'] ?? '';
            if (empty($itemId)) {
                return ToolResult::error('item_id is required.');
            }

            $result = $this->service->getItem((int) $itemId);
            $items = $result['data']['items'] ?? [];
            $item = $items[0] ?? null;

            if ($item === null) {
                return ToolResult::error("Item not found: {$itemId}");
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
                'creator' => isset($item['creator']) ? [
                    'id' => $item['creator']['id'] ?? '',
                    'name' => $item['creator']['name'] ?? '',
                ] : null,
                'column_values' => array_map(fn (array $cv) => [
                    'id' => $cv['id'] ?? '',
                    'title' => $cv['title'] ?? '',
                    'type' => $cv['type'] ?? '',
                    'text' => $cv['text'] ?? '',
                    'value' => $cv['value'] ?? null,
                ], $item['column_values'] ?? []),
                'created_at' => $item['created_at'] ?? '',
                'updated_at' => $item['updated_at'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
