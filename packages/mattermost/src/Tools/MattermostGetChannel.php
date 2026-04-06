<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Mattermost channel by ID.
 *
 * Returns the full channel object including id, name, display_name,
 * header, purpose, type, team_id, creator_id, and timestamps.
 */
class MattermostGetChannel implements Tool
{
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_get_channel';
    }

    public function description(): string
    {
        return 'Get details of a specific Mattermost channel by ID. Returns channel name, display name, type, header, purpose, and member counts.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The channel ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $channelId = $args['channel_id'] ?? '';
            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }

            $result = $this->service->getChannel($channelId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
