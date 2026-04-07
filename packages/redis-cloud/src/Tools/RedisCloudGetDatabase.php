<?php

namespace OpenCompany\Integrations\RedisCloud\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RedisCloud\RedisCloudService;

/**
 * Tool to get details for a specific Redis Cloud database.
 *
 * Calls GET /v1/subscriptions/{subscriptionId}/databases/{databaseId}
 * on the Redis Cloud REST API.
 */
class RedisCloudGetDatabase implements Tool
{
    public function __construct(
        private RedisCloudService $service,
    ) {}

    public function name(): string
    {
        return 'redis_cloud_get_database';
    }

    public function description(): string
    {
        return 'Get details for a specific Redis Cloud database by subscription and database ID, including endpoint, memory usage, throughput, and replication status.';
    }

    public function parameters(): array
    {
        return [
            'subscription_id' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'The Redis Cloud subscription ID.',
            ],
            'database_id' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'The database ID within the subscription.',
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
            $databaseId = $args['database_id'] ?? null;

            if (empty($subscriptionId)) {
                return ToolResult::error('The "subscription_id" parameter is required.');
            }

            if (empty($databaseId)) {
                return ToolResult::error('The "database_id" parameter is required.');
            }

            $result = $this->service->getDatabase((int) $subscriptionId, (int) $databaseId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
