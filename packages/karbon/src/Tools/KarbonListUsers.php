<?php

namespace OpenCompany\Integrations\Karbon\Tools;

use OpenCompany\Integrations\Karbon\KarbonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KarbonListUsers implements Tool
{
    public function __construct(
        private KarbonService $service,
    ) {}

    public function name(): string
    {
        return 'karbon_list_users';
    }

    public function description(): string
    {
        return 'List users in the Karbon account. Returns user details including names, emails, and roles. Use this to find assignees for work items.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of users to return (default: 20).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Karbon integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listUsers($limit);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
