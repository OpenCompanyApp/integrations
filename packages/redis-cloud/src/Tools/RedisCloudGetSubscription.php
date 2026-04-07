<?php

namespace OpenCompany\Integrations\RedisCloud\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RedisCloud\RedisCloudService;

/**
 * Tool to get details for a specific Redis Cloud subscription.
 *
 * Calls GET /v1/subscriptions/{id} on the Redis Cloud REST API.
 */
class RedisCloudGetSubscription implements Tool
{
    public function __construct(
        private RedisCloudService $service,
    ) {}

    public function name(): string
    {
        return 'redis_cloud_get_subscription';
    }

    public function description(): string
    {
        return 'Get details for a specific Redis Cloud subscription by ID, including plan, region, memory, throughput, and database list.';
    }

    public function parameters(): array
    {
        return [
            'subscription_id' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'The Redis Cloud subscription ID.',
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

            $result = $this->service->getSubscription((int) $subscriptionId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
