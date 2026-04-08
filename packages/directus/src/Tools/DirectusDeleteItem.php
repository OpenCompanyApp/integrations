<?php

namespace OpenCompany\Integrations\Directus\Tools;

use OpenCompany\Integrations\Directus\DirectusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DirectusDeleteItem implements Tool
{
    public function __construct(
        private DirectusService $service,
    ) {}

    public function name(): string
    {
        return 'directus_delete_item';
    }

    public function description(): string
    {
        return 'Delete an item from a Directus collection by its primary key ID. This action cannot be undone.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name (e.g. "articles", "products").'],
            'id'         => ['type' => 'string', 'required' => true, 'description' => 'The primary key of the item to delete.'],
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

            $this->service->deleteItem($collection, $id);

            return ToolResult::success("Item {$id} deleted from collection '{$collection}'.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
