<?php

namespace OpenCompany\Integrations\Wildix\Tools;

use OpenCompany\Integrations\Wildix\WildixService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WildixListUsers implements Tool
{
    public function __construct(
        private WildixService $service,
    ) {}

    public function name(): string
    {
        return 'wildix_list_users';
    }

    public function description(): string
    {
        return 'List users configured in the Wildix PBX system. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of users to return (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wildix integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;

            $result = $this->service->listUsers($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
