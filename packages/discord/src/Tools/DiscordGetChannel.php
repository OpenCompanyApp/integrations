<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about a Discord channel.
 *
 * Returns the channel's ID, name, type, topic, and other properties.
 */
class DiscordGetChannel implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_get_channel';
    }

    public function description(): string
    {
        return <<<'MD'
        Get information about a Discord channel by its ID.
        Returns the channel's ID, name, type, topic, and other properties.
        MD;
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel to retrieve.'],
        ];
    }

    /**
     * Get channel information by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel_id)
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
