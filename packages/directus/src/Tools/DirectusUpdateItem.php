<?php

namespace OpenCompany\Integrations\Directus\Tools;

use OpenCompany\Integrations\Directus\DirectusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DirectusUpdateItem implements Tool
{
    public function __construct(
        private DirectusService $service,
    ) {}

    public function name(): string
    {
        return 'directus_update_item';
    }

    public function description(): string
    {
        return 'Update an existing item in a Directus collection by its primary key ID.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name (e.g. "articles", "products").'],
            'id'         => ['type' => 'string', 'required' => true, 'description' => 'The primary key of the item to update.'],
            'data'       => ['type' => 'object', 'required' => true, 'description' => 'Object containing the field values to update. Keys are field names, values are the new data.'],
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
            $data = $args['data'];

            if (empty($data) || !is_array($data)) {
                return ToolResult::error('The "data" parameter must be a non-empty object with field values to update.');
            }

            $result = $this->service->updateItem($collection, $id, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
