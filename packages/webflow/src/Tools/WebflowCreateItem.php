<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new item in a Webflow collection.
 */
class WebflowCreateItem implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_create_item';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new item in a Webflow collection.
        Provide the collection ID and a fields object matching the collection schema.
        Optionally set is_draft to create as a draft or is_archived to archive on creation.
        MD;
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow collection.'],
            'fields' => ['type' => 'string', 'required' => true, 'description' => 'Item field data as a JSON object. Keys should match the collection field slugs.'],
            'is_draft' => ['type' => 'boolean', 'description' => 'Whether the item should be created as a draft (default false).'],
            'is_archived' => ['type' => 'boolean', 'description' => 'Whether the item should be archived on creation (default false).'],
        ];
    }

    /**
     * Create a new item in a collection with the provided field data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (collection_id, fields, is_draft, is_archived)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            $collectionId = $args['collection_id'] ?? '';

            if (empty($collectionId)) {
                return ToolResult::error('collection_id is required.');
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

            $result = $this->service->createItem($collectionId, $fields, $isDraft, $isArchived);

            $item = $result['item'] ?? $result;

            return ToolResult::success([
                'id' => $item['id'] ?? '',
                'createdOn' => $item['createdOn'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
