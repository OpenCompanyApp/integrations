<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List items in a Webflow collection with optional pagination.
 */
class WebflowListItems implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_list_items';
    }

    public function description(): string
    {
        return <<<'MD'
        List items in a Webflow collection with optional pagination.
        Returns item IDs, names, slugs, field data, and publication status.
        Use limit and offset to paginate through large collections.
        MD;
    }

    public function parameters(): array
    {
        return [
            'collection_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow collection.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of items to return (default 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of items to skip for pagination (default 0).'],
        ];
    }

    /**
     * List items in a collection with optional pagination.
     *
     * @param  array<string, mixed>  $args  Tool arguments (collection_id, limit, offset)
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

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listItems($collectionId, $limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
