<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add an emoji reaction to a Discord message.
 */
class DiscordAddReaction implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_add_reaction';
    }

    public function description(): string
    {
        return 'Add an emoji reaction to a Discord message.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel the message is in.'],
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the message to react to.'],
            'emoji'      => ['type' => 'string', 'required' => true, 'description' => 'The emoji to react with. URL-encoded for unicode (e.g., "%F0%9F%91%8D" for 👍) or "name:id" for custom emojis.'],
        ];
    }

    /**
     * Add a reaction to a message.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel_id, message_id, emoji)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $channelId = $args['channel_id'] ?? '';
            $messageId = $args['message_id'] ?? '';
            $emoji = $args['emoji'] ?? '';

            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }
            if (empty($messageId)) {
                return ToolResult::error('message_id is required.');
            }
            if (empty($emoji)) {
                return ToolResult::error('emoji is required.');
            }

            $this->service->addReaction($channelId, $messageId, $emoji);

            return ToolResult::success([
                'ok' => true,
                'channel_id' => $channelId,
                'message_id' => $messageId,
                'emoji' => $emoji,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
