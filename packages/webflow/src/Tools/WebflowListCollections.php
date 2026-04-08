<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebflowListCollections implements Tool
{
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_list_collections';
    }

    public function description(): string
    {
        return 'List CMS collections for a Webflow site. Collections are content models (e.g., "Blog Posts", "Team Members") that hold structured items.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the Webflow site.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of collections to return (default: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of collections to skip for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            if (empty($args['site_id'])) {
                return ToolResult::error('Site ID is required.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listCollections($args['site_id'], $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
