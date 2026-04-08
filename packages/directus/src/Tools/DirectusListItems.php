<?php

namespace OpenCompany\Integrations\Directus\Tools;

use OpenCompany\Integrations\Directus\DirectusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DirectusListItems implements Tool
{
    public function __construct(
        private DirectusService $service,
    ) {}

    public function name(): string
    {
        return 'directus_list_items';
    }

    public function description(): string
    {
        return 'List items in a Directus collection with optional filtering, sorting, and pagination. Returns an array of items from the specified collection.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name to query (e.g. "articles", "products").'],
            'limit'      => ['type' => 'integer', 'description' => 'Maximum number of items to return (default: 100, max depends on instance).'],
            'offset'     => ['type' => 'integer', 'description' => 'Number of items to skip for pagination.'],
            'sort'       => ['type' => 'string', 'description' => 'Sort field(s). Prefix with "-" for descending (e.g. "-date_created").'],
            'filter'     => ['type' => 'object', 'description' => 'Directus filter object for querying. E.g. {"status": {"_eq": "published"}}.'],
            'fields'     => ['type' => 'string', 'description' => 'Comma-separated list of fields to include in the response.'],
            'search'     => ['type' => 'string', 'description' => 'Search query to filter items across searchable fields.'],
            'page'       => ['type' => 'integer', 'description' => 'Page number for pagination (alternative to offset).'],
            'meta'       => ['type' => 'string', 'description' => 'Metadata to include. Use "total_count" to get total matching items.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Directus integration is not configured.');
            }

            $collection = $args['collection'];
            $params = [];

            $optionalKeys = ['limit', 'offset', 'sort', 'filter', 'fields', 'search', 'page', 'meta'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listItems($collection, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
