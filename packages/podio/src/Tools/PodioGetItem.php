<?php

namespace OpenCompany\Integrations\Podio\Tools;

use OpenCompany\Integrations\Podio\PodioService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Podio item.
 *
 * Returns full item data including all field values, comments, files, and revision history.
 */
class PodioGetItem implements Tool
{
    public function __construct(
        private PodioService $service,
    ) {}

    public function name(): string
    {
        return 'podio_get_item';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Podio item, including all field values, references, and metadata. Use the item ID obtained from podio_list_items.';
    }

    public function parameters(): array
    {
        return [
            'item_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Podio item ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Podio integration is not configured.');
            }

            $itemId = (int) $args['item_id'];
            $item = $this->service->getItem($itemId);

            return ToolResult::success($item);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
