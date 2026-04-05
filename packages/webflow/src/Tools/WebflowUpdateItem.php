<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing item in a Webflow collection.
 */
class WebflowUpdateItem implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_update_item';
    }

    public function description(): string
    {
        return <<<'MD'
        Update an existing item in a Webflow collection.
        Provide the collection ID, item ID, and a fields object with the values to update.
        Optionally set is_draft or is_archived to change the item status.
        MD;
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow collection.'],
            'item_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the item to update.'],
            'fields' => ['type' => 'string', 'required' => true, 'description' => 'Item field data to update as a JSON object. Keys should match the collection field slugs.'],
            'is_draft' => ['type' => 'boolean', 'description' => 'Whether the item should be a draft (default false).'],
            'is_archived' => ['type' => 'boolean', 'description' => 'Whether the item should be archived (default false).'],
        ];
    }

    /**
     * Update an existing item in a collection with the provided field data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (collection_id, item_id, fields, is_draft, is_archived)
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

            $fieldsRaw = $args['fields'] ?? '';

            if (empty($fieldsRaw)) {
                return ToolResult::error('fields is required.');
            }

            $fields = $fieldsRaw;
            if (is_string($fieldsRaw)) {
                $decoded = json_decode($fieldsRaw, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return ToolResult::error('Invalid JSON in fields: ' . json_last_error_msg());
                }
                $fields = $decoded;
            }

            $isDraft = ! empty($args['is_draft']);
            $isArchived = ! empty($args['is_archived']);

            $result = $this->service->updateItem($collectionId, $itemId, $fields, $isDraft, $isArchived);

            $item = $result['item'] ?? $result;

            return ToolResult::success([
                'id' => $item['id'] ?? '',
                'updatedOn' => $item['updatedOn'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
