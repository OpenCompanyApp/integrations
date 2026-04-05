<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a channel in a Discord guild.
 *
 * Supports text (0), voice (2), category (4), stage (13), and forum (15) channel types.
 */
class DiscordCreateChannel implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_create_channel';
    }

    public function description(): string
    {
        return 'Create a channel in a Discord guild. Supports text, voice, category, stage, and forum channel types.';
    }

    public function parameters(): array
    {
        return [
            'guild_id'   => ['type' => 'string', 'required' => true, 'description' => 'The ID of the guild to create the channel in.'],
            'name'       => ['type' => 'string', 'required' => true, 'description' => 'The name of the new channel (1–100 characters).'],
            'type'       => ['type' => 'integer', 'description' => 'Channel type: 0=text, 2=voice, 4=category, 13=stage, 15=forum. Default: 0 (text).'],
            'topic'      => ['type' => 'string', 'description' => 'The channel topic (0–1024 characters).'],
            'parent_id'  => ['type' => 'string', 'description' => 'The ID of the parent category channel.'],
        ];
    }

    /**
     * Create a channel in a guild.
     *
     * @param  array<string, mixed>  $args  Tool arguments (guild_id, name, type, topic, parent_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $guildId = $args['guild_id'] ?? '';
            $name = $args['name'] ?? '';

            if (empty($guildId)) {
                return ToolResult::error('guild_id is required.');
            }
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (isset($args['type'])) {
                $data['type'] = (int) $args['type'];
            }
            if (isset($args['topic'])) {
                $data['topic'] = $args['topic'];
            }
            if (isset($args['parent_id'])) {
                $data['parent_id'] = $args['parent_id'];
            }

            $result = $this->service->createChannel($guildId, $data);

            return ToolResult::success([
                'ok' => true,
                'channel' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
