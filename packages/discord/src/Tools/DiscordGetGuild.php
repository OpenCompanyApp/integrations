<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about a Discord guild.
 */
class DiscordGetGuild implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_get_guild';
    }

    public function description(): string
    {
        return 'Get information about a Discord guild by its ID.';
    }

    public function parameters(): array
    {
        return [
            'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the guild to retrieve.'],
        ];
    }

    /**
     * Get guild information by ID.
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

            $result = $this->service->getGuild($guildId);

            return ToolResult::success([
                'ok' => true,
                'guild' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
