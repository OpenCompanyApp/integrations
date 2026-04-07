<?php

namespace OpenCompany\Integrations\RedisCloud\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RedisCloud\RedisCloudService;

/**
 * Tool to list all databases within a Redis Cloud subscription.
 *
 * Calls GET /v1/subscriptions/{subscriptionId}/databases on the Redis Cloud REST API.
 */
class RedisCloudListDatabases implements Tool
{
    public function __construct(
        private RedisCloudService $service,
    ) {}

    public function name(): string
    {
        return 'redis_cloud_list_databases';
    }

    public function description(): string
    {
        return 'List all databases within a Redis Cloud subscription. Returns database IDs, names, endpoints, and statuses.';
    }

    public function parameters(): array
    {
        return [
            'subscription_id' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'The Redis Cloud subscription ID to list databases for.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Redis Cloud integration is not configured.');
            }

            $subscriptionId = $args['subscription_id'] ?? null;

            if (empty($subscriptionId)) {
                return ToolResult::error('The "subscription_id" parameter is required.');
            }

            $result = $this->service->listDatabases((int) $subscriptionId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
