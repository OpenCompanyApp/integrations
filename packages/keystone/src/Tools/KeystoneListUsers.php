<?php

namespace OpenCompany\Integrations\Keystone\Tools;

use OpenCompany\Integrations\Keystone\KeystoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KeystoneListUsers implements Tool
{
    public function __construct(
        private KeystoneService $service,
    ) {}

    public function name(): string
    {
        return 'keystone_list_users';
    }

    public function description(): string
    {
        return 'List users in the KeystoneJS instance with optional filtering, sorting, and pagination.';
    }

    public function parameters(): array
    {
        return [
            'take'   => ['type' => 'integer', 'description' => 'Maximum number of users to return (default: 50).'],
            'skip'   => ['type' => 'integer', 'description' => 'Number of users to skip for pagination.'],
            'sort'   => ['type' => 'string', 'description' => 'Sort field(s). Prefix with "-" for descending.'],
            'where'  => ['type' => 'object', 'description' => 'Filter object for querying. E.g. {"role": {"equals": "admin"}}.'],
            'search' => ['type' => 'string', 'description' => 'Search query to filter users by name or email.'],
            'fields' => ['type' => 'string', 'description' => 'Comma-separated list of fields to include in the response.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Keystone integration is not configured.');
            }

            $params = [];

            $optionalKeys = ['take', 'skip', 'sort', 'where', 'search', 'fields'];

            foreach ($optionalKeys as $key) {
                if (isset($args[$key])) {
                    $params[$key] = $args[$key];
                }
            }

            $result = $this->service->listUsers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
