<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

use OpenCompany\Integrations\Mattermost\MattermostService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Mattermost channel by ID.
 */
class MattermostGetChannel implements Tool
{
    /**
     * @param  MattermostService  $service  The Mattermost API client
     */
    public function __construct(
        private MattermostService $service,
    ) {}

    public function name(): string
    {
        return 'mattermost_get_channel';
    }

    public function description(): string
    {
        return 'Get a Mattermost channel by its ID.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel to retrieve.'],
        ];
    }

    /**
     * Get a Mattermost channel by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mattermost integration is not configured.');
            }

            $channelId = $args['channel_id'] ?? '';

            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }

            $result = $this->service->getChannel($channelId);

            return ToolResult::success([
                'ok' => true,
                'channel' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
