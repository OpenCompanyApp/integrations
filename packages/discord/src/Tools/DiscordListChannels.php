<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all channels in a Discord guild.
 *
 * Returns an array of channel objects with IDs, names, types, and topics.
 */
class DiscordListChannels implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_list_channels';
    }

    public function description(): string
    {
        return <<<'MD'
        List all channels in a Discord guild.
        Returns channel IDs, names, types, and topics.
        MD;
    }

    public function parameters(): array
    {
        return [
            'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the guild to list channels for.'],
        ];
    }

    /**
     * List channels in a Discord guild.
     *
     * @param  array<string, mixed>  $args  Tool arguments (guild_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $guildId = $args['guild_id'] ?? '';

            if (empty($guildId)) {
                return ToolResult::error('guild_id is required.');
            }

            $result = $this->service->listChannels($guildId);

            $channels = array_map(function (array $channel): array {
                return [
                    'id' => $channel['id'] ?? '',
                    'name' => $channel['name'] ?? '',
                    'type' => $channel['type'] ?? 0,
                    'topic' => $channel['topic'] ?? '',
                    'parent_id' => $channel['parent_id'] ?? null,
                ];
            }, $result);

            return ToolResult::success([
                'results' => $channels,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
