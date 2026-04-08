<?php

namespace OpenCompany\Integrations\Keystone\Tools;

use OpenCompany\Integrations\Keystone\KeystoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KeystoneGetItem implements Tool
{
    public function __construct(
        private KeystoneService $service,
    ) {}

    public function name(): string
    {
        return 'keystone_get_item';
    }

    public function description(): string
    {
        return 'Retrieve a single item from a KeystoneJS list by its ID.';
    }

    public function parameters(): array
    {
        return [
            'list_key' => ['type' => 'string', 'required' => true, 'description' => 'The list key (e.g. "posts", "users", "products").'],
            'id'       => ['type' => 'string', 'required' => true, 'description' => 'The ID of the item to retrieve.'],
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
            $id = $args['id'] ?? '';

            if (empty($listKey)) {
                return ToolResult::error('The "list_key" parameter is required.');
            }

            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $params = [];

            if (isset($args['fields'])) {
                $params['fields'] = $args['fields'];
            }

            $result = $this->service->getItem($listKey, $id, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
