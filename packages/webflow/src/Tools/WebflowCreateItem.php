<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebflowCreateItem implements Tool
{
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_create_item';
    }

    public function description(): string
    {
        return 'Create a new item in a Webflow CMS collection. Pass field data as key-value pairs matching the collection\'s schema. Set live to true to publish immediately.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the CMS collection to add the item to.'],
            'fields' => ['type' => 'object', 'required' => true, 'description' => 'Field data as key-value pairs matching the collection schema. Common fields: name, slug, _archived, _draft.'],
            'live' => ['type' => 'boolean', 'description' => 'Whether to publish the item immediately (default: false). Set to true to make the item live on the site.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            if (empty($args['collection_id'])) {
                return ToolResult::error('Collection ID is required.');
            }

            if (empty($args['fields']) || !is_array($args['fields'])) {
                return ToolResult::error('Fields must be a non-empty object with key-value pairs.');
            }

            $live = isset($args['live']) && (bool) $args['live'];

            $result = $this->service->createItem($args['collection_id'], $args['fields'], $live);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
