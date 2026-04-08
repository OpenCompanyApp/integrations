<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebflowGetItem implements Tool
{
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_get_item';
    }

    public function description(): string
    {
        return 'Get a single CMS item from a Webflow collection by its ID. Returns full field data including rich text, images, and references.';
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the CMS collection the item belongs to.'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the CMS item.'],
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

            if (empty($args['id'])) {
                return ToolResult::error('Item ID is required.');
            }

            $result = $this->service->getItem($args['collection_id'], $args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
