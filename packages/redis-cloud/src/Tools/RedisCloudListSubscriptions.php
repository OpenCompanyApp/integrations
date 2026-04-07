<?php

namespace OpenCompany\Integrations\RedisCloud\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RedisCloud\RedisCloudService;

/**
 * Tool to list all subscriptions in the Redis Cloud account.
 *
 * Calls GET /v1/subscriptions on the Redis Cloud REST API.
 */
class RedisCloudListSubscriptions implements Tool
{
    public function __construct(
        private RedisCloudService $service,
    ) {}

    public function name(): string
    {
        return 'redis_cloud_list_subscriptions';
    }

    public function description(): string
    {
        return 'List all subscriptions in the Redis Cloud account. Returns subscription IDs, names, regions, statuses, and database counts.';
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

            $result = $this->service->listSubscriptions();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
