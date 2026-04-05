<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get messages from a Discord channel.
 *
 * Supports pagination via before/after cursors and a limit parameter.
 */
class DiscordGetMessages implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_get_messages';
    }

    public function description(): string
    {
        return 'Get messages from a Discord channel. Supports pagination with before/after and limit.';
    }

    public function parameters(): array
    {
        return [
            'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the channel to get messages from.'],
            'limit'      => ['type' => 'integer', 'description' => 'Number of messages to retrieve (1–100, default 50).'],
            'before'     => ['type' => 'string', 'description' => 'Message ID to get messages before (for pagination).'],
            'after'      => ['type' => 'string', 'description' => 'Message ID to get messages after (for pagination).'],
        ];
    }

    /**
     * Retrieve messages from a Discord channel.
     *
     * @param  array<string, mixed>  $args  Tool arguments (channel_id, limit, before, after)
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

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['before'])) {
                $params['before'] = $args['before'];
            }
            if (isset($args['after'])) {
                $params['after'] = $args['after'];
            }

            $result = $this->service->getMessages($channelId, $params);

            return ToolResult::success([
                'ok' => true,
                'messages' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
