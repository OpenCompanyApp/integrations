<?php

namespace OpenCompany\Integrations\RedisCloud\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RedisCloud\RedisCloudService;

/**
 * Tool to get the current Redis Cloud account information.
 *
 * Calls GET /v1/accounts/current on the Redis Cloud REST API.
 */
class RedisCloudGetCurrentAccount implements Tool
{
    public function __construct(
        private RedisCloudService $service,
    ) {}

    public function name(): string
    {
        return 'redis_cloud_get_current_account';
    }

    public function description(): string
    {
        return 'Get the current Redis Cloud account information, including owner email, payment method, and plan details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Redis Cloud integration is not configured.');
            }

            $result = $this->service->getCurrentAccount();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
