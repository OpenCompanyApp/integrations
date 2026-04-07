<?php

namespace OpenCompany\Integrations\Teams\Tools;

use OpenCompany\Integrations\Teams\TeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get detailed information about a Microsoft Teams channel.
 */
class TeamsGetChannel implements Tool
{
    /**
     * @param  TeamsService  $service  The Microsoft Graph API client
     */
    public function __construct(
        private TeamsService $service,
    ) {}

    public function name(): string
    {
        return 'teams_get_channel';
    }

    public function description(): string
    {
        return 'Get detailed information about a Microsoft Teams channel.';
    }

    public function parameters(): array
    {
        return [
            'team_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the team.'],
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel.'],
        ];
    }

    /**
     * Get channel info by team and channel ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (team_id, channel_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Microsoft Teams integration is not configured.');
            }

            $teamId = $args['team_id'] ?? '';
            $channelId = $args['channel_id'] ?? '';

            if (empty($teamId)) {
                return ToolResult::error('team_id is required.');
            }
            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }

            $result = $this->service->getChannel($teamId, $channelId);

            return ToolResult::success([
                'ok' => true,
                'channel' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
