<?php

namespace OpenCompany\Integrations\Keystone\Tools;

use OpenCompany\Integrations\Keystone\KeystoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KeystoneGetList implements Tool
{
    public function __construct(
        private KeystoneService $service,
    ) {}

    public function name(): string
    {
        return 'keystone_get_list';
    }

    public function description(): string
    {
        return 'Get metadata and field schema for a specific KeystoneJS list. Returns field definitions, access control, and display configuration.';
    }

    public function parameters(): array
    {
        return [
            'list_key' => ['type' => 'string', 'required' => true, 'description' => 'The list key (e.g. "posts", "users", "comments").'],
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

            $result = $this->service->getList($listKey);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
