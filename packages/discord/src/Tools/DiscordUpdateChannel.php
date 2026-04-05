<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Discord channel's properties.
 *
 * Supports updating name, topic, and slowmode interval.
 */
class DiscordUpdateChannel implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_update_channel';
    }

    public function description(): string
    {
        return 'Update a Discord channel\'s properties such as name, topic, and slowmode interval.';
    }

    public function parameters(): array
    {
        return [
            'channel_id'           => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel to update.'],
            'name'                 => ['type' => 'string', 'description' => 'The new name of the channel.'],
            'topic'                => ['type' => 'string', 'description' => 'The new channel topic (0–1024 characters).'],
            'slowmode_interval'    => ['type' => 'integer', 'description' => 'Slowmode delay in seconds (0–21600). Set to 0 to disable.'],
        ];
    }

    /**
     * Update a channel's properties.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel_id, name, topic, slowmode_interval)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $channelId = $args['channel_id'] ?? '';

            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }

            $data = [];

            if (isset($args['name'])) {
                $data['name'] = $args['name'];
            }
            if (isset($args['topic'])) {
                $data['topic'] = $args['topic'];
            }
            if (isset($args['slowmode_interval'])) {
                $data['rate_limit_per_user'] = (int) $args['slowmode_interval'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one of name, topic, or slowmode_interval is required.');
            }

            $result = $this->service->updateChannel($channelId, $data);

            return ToolResult::success([
                'ok' => true,
                'channel' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
