<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Discord message by its ID.
 */
class DiscordDeleteMessage implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_delete_message';
    }

    public function description(): string
    {
        return 'Delete a Discord message by its ID.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel the message is in.'],
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the message to delete.'],
        ];
    }

    /**
     * Delete a message by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel_id, message_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $channelId = $args['channel_id'] ?? '';
            $messageId = $args['message_id'] ?? '';

            if (empty($channelId)) {
                return ToolResult::error('channel_id is required.');
            }
            if (empty($messageId)) {
                return ToolResult::error('message_id is required.');
            }

            $this->service->deleteMessage($channelId, $messageId);

            return ToolResult::success([
                'ok' => true,
                'channel_id' => $channelId,
                'message_id' => $messageId,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
