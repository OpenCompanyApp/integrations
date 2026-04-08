<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get information about a Discord guild.
 *
 * Returns the guild's ID, name, icon, description, member count, and other properties.
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
        return <<<'MD'
        Get information about a Discord guild by its ID.
        Returns the guild's ID, name, icon, description, member count, and other properties.
        MD;
    }

    public function parameters(): array
    {
        return [
            'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the guild to retrieve.'],
        ];
    }

    /**
     * Retrieve a Discord guild by ID.
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
                'id' => $result['id'] ?? '',
                'name' => $result['name'] ?? '',
                'icon' => $result['icon'] ?? null,
                'description' => $result['description'] ?? '',
                'member_count' => $result['approximate_member_count'] ?? $result['member_count'] ?? null,
                'owner_id' => $result['owner_id'] ?? '',
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
