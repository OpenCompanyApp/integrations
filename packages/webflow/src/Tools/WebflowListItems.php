<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebflowListItems implements Tool
{
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_list_items';
    }

    public function description(): string
    {
        return 'List items in a Webflow CMS collection. Returns paginated results with item IDs, field data, and draft/publish status.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the CMS collection.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of items to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of items to skip for pagination (default: 0).'],
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

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listItems($args['collection_id'], $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
