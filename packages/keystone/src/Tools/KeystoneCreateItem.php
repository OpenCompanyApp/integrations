<?php

namespace OpenCompany\Integrations\Keystone\Tools;

use OpenCompany\Integrations\Keystone\KeystoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KeystoneCreateItem implements Tool
{
    public function __construct(
        private KeystoneService $service,
    ) {}

    public function name(): string
    {
        return 'keystone_create_item';
    }

    public function description(): string
    {
        return 'Create a new item in a KeystoneJS list with the provided field values.';
    }

    public function parameters(): array
    {
        return [
            'list_key' => ['type' => 'string', 'required' => true, 'description' => 'The list key (e.g. "posts", "users", "products").'],
            'data'     => ['type' => 'object', 'required' => true, 'description' => 'Object containing the field values for the new item. Keys are field names, values are the field data.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keystone integration is not configured.');
            }

            $listKey = $args['list_key'] ?? '';
            $data = $args['data'] ?? [];

            if (empty($listKey)) {
                return ToolResult::error('The "list_key" parameter is required.');
            }

            if (empty($data) || !is_array($data)) {
                return ToolResult::error('The "data" parameter must be a non-empty object with field values.');
            }

            $result = $this->service->createItem($listKey, $data);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
