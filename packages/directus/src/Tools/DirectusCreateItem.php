<?php

namespace OpenCompany\Integrations\Directus\Tools;

use OpenCompany\Integrations\Directus\DirectusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class DirectusCreateItem implements Tool
{
    public function __construct(
        private DirectusService $service,
    ) {}

    public function name(): string
    {
        return 'directus_create_item';
    }

    public function description(): string
    {
        return 'Create a new item in a Directus collection with the provided field values.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name (e.g. "articles", "products").'],
            'data'       => ['type' => 'object', 'required' => true, 'description' => 'Object containing the field values for the new item. Keys are field names, values are the field data.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Directus integration is not configured.');
            }

            $collection = $args['collection'];
            $data = $args['data'];

            if (empty($data) || !is_array($data)) {
                return ToolResult::error('The "data" parameter must be a non-empty object with field values.');
            }

            $result = $this->service->createItem($collection, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
