<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Send a message to a Discord channel.
 *
 * Supports plain text content and rich embeds.
 */
class DiscordSendMessage implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_send_message';
    }

    public function description(): string
    {
        return <<<'MD'
        Send a message to a Discord channel. Supports text content and rich embeds.
        Returns the sent message ID and channel ID.
        MD;
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel to send the message to.'],
            'content'    => ['type' => 'string', 'description' => 'The text content of the message.'],
            'embeds'     => ['type' => 'string', 'description' => 'JSON array of embed objects for rich formatting.'],
            'tts'        => ['type' => 'boolean', 'description' => 'If true, the message will be read aloud via text-to-speech.'],
        ];
    }

    /**
     * Send a message to a Discord channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel_id, content, embeds, tts)
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

            if (empty($args['content']) && empty($args['embeds'])) {
                return ToolResult::error('content or embeds is required.');
            }

            $data = [];

            if (isset($args['content'])) {
                $data['content'] = $args['content'];
            }

            if (isset($args['embeds'])) {
                $embeds = $args['embeds'];
                $data['embeds'] = is_string($embeds) ? json_decode($embeds, true) : $embeds;
            }

            if (isset($args['tts'])) {
                $data['tts'] = (bool) $args['tts'];
            }

            $result = $this->service->sendMessage($channelId, $data);

            return ToolResult::success([
                'ok' => true,
                'id' => $result['id'] ?? '',
                'channel_id' => $result['channel_id'] ?? $channelId,
                'content' => $result['content'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
