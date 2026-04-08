<?php

namespace OpenCompany\Integrations\Directus\Tools;

use OpenCompany\Integrations\Directus\DirectusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DirectusGetItem implements Tool
{
    public function __construct(
        private DirectusService $service,
    ) {}

    public function name(): string
    {
        return 'directus_get_item';
    }

    public function description(): string
    {
        return 'Retrieve a single item from a Directus collection by its primary key ID.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name (e.g. "articles", "products").'],
            'id'         => ['type' => 'string', 'required' => true, 'description' => 'The primary key of the item to retrieve.'],
            'fields'     => ['type' => 'string', 'description' => 'Comma-separated list of fields to include in the response.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Directus integration is not configured.');
            }

            $collection = $args['collection'];
            $id = $args['id'];
            $params = [];

            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->getItem($collection, $id, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
