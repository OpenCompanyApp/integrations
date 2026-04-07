<?php

namespace OpenCompany\Integrations\RedisCloud\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\RedisCloud\RedisCloudService;

/**
 * Tool to get details for a specific Redis Cloud team (ACL role).
 *
 * Calls GET /v1/teams/{id} on the Redis Cloud REST API.
 */
class RedisCloudGetTeam implements Tool
{
    public function __construct(
        private RedisCloudService $service,
    ) {}

    public function name(): string
    {
        return 'redis_cloud_get_team';
    }

    public function description(): string
    {
        return 'Get details for a specific Redis Cloud team (ACL role) by ID, including roles, permissions, and assigned databases.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => [
                'type' => 'integer',
                'required' => true,
                'description' => 'The Redis Cloud team ID.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Redis Cloud integration is not configured.');
            }

            $teamId = $args['team_id'] ?? null;

            if (empty($teamId)) {
                return ToolResult::error('The "team_id" parameter is required.');
            }

            $result = $this->service->getTeam((int) $teamId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
