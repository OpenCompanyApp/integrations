<?php

namespace OpenCompany\Integrations\Keystone\Tools;

use OpenCompany\Integrations\Keystone\KeystoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KeystoneListItems implements Tool
{
    public function __construct(
        private KeystoneService $service,
    ) {}

    public function name(): string
    {
        return 'keystone_list_items';
    }

    public function description(): string
    {
        return 'List items in a KeystoneJS list with optional filtering, sorting, and pagination. Returns an array of items from the specified list.';
    }

    public function parameters(): array
    {
        return [
            'list_key' => ['type' => 'string', 'required' => true, 'description' => 'The list key to query (e.g. "posts", "users", "products").'],
            'take'     => ['type' => 'integer', 'description' => 'Maximum number of items to return (default: 50).'],
            'skip'     => ['type' => 'integer', 'description' => 'Number of items to skip for pagination.'],
            'sort'     => ['type' => 'string', 'description' => 'Sort field(s). Prefix with "-" for descending (e.g. "-createdAt").'],
            'where'    => ['type' => 'object', 'description' => 'Filter object for querying. E.g. {"status": {"equals": "published"}}.'],
            'search'   => ['type' => 'string', 'description' => 'Search query to filter items across searchable fields.'],
            'fields'   => ['type' => 'string', 'description' => 'Comma-separated list of fields to include in the response.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keystone integration is not configured.');
            }

            $listKey = $args['list_key'] ?? '';
            if (empty($listKey)) {
                return ToolResult::error('The "list_key" parameter is required.');
            }

            $params = [];

            $optionalKeys = ['take', 'skip', 'sort', 'where', 'search', 'fields'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listItems($listKey, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
