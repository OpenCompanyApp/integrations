<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a single item from a Webflow collection by its ID.
 */
class WebflowGetItem implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_get_item';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single item from a Webflow collection by its ID.
        Returns the full item object with all field data.
        MD;
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow collection.'],
            'item_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the item to retrieve.'],
        ];
    }

    /**
     * Get a single item from a collection by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (collection_id, item_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            $collectionId = $args['collection_id'] ?? '';
            $itemId = $args['item_id'] ?? '';

            if (empty($collectionId)) {
                return ToolResult::error('collection_id is required.');
            }

            if (empty($itemId)) {
                return ToolResult::error('item_id is required.');
            }

            $result = $this->service->getItem($collectionId, $itemId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
