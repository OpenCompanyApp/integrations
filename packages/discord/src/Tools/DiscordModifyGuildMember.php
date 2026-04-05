<?php

namespace OpenCompany\Integrations\Discord\Tools;

use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Modify a guild member's properties in Discord.
 *
 * Supports updating nickname, roles, mute, and deafen status.
 */
class DiscordModifyGuildMember implements Tool
{
    /**
     * @param  DiscordService  $service  The Discord API client
     */
    public function __construct(
        private DiscordService $service,
    ) {}

    public function name(): string
    {
        return 'discord_modify_guild_member';
    }

    public function description(): string
    {
        return 'Modify a guild member\'s properties such as nickname, roles, mute, and deafen status.';
    }

    public function parameters(): array
    {
        return [
            'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the guild.'],
            'user_id'  => ['type' => 'string', 'required' => true, 'description' => 'The ID of the member to modify.'],
            'nick'     => ['type' => 'string', 'description' => 'The new nickname for the member.'],
            'roles'    => ['type' => 'string', 'description' => 'JSON array of role IDs to assign to the member.'],
            'mute'     => ['type' => 'boolean', 'description' => 'Whether to mute the member in voice channels.'],
            'deaf'     => ['type' => 'boolean', 'description' => 'Whether to deafen the member in voice channels.'],
        ];
    }

    /**
     * Modify a guild member's properties.
     *
     * @param  array<string, mixed>  $args  Tool arguments (guild_id, user_id, nick, roles, mute, deaf)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Discord integration is not configured.');
            }

            $guildId = $args['guild_id'] ?? '';
            $userId = $args['user_id'] ?? '';

            if (empty($guildId)) {
                return ToolResult::error('guild_id is required.');
            }
            if (empty($userId)) {
                return ToolResult::error('user_id is required.');
            }

            $data = [];

            if (array_key_exists('nick', $args)) {
                $data['nick'] = $args['nick'] ?? '';
            }
            if (isset($args['roles'])) {
                $roles = $args['roles'];
                $data['roles'] = is_string($roles) ? json_decode($roles, true) : $roles;
            }
            if (isset($args['mute'])) {
                $data['mute'] = (bool) $args['mute'];
            }
            if (isset($args['deaf'])) {
                $data['deaf'] = (bool) $args['deaf'];
            }

            if (empty($data)) {
                return ToolResult::error('At least one of nick, roles, mute, or deaf is required.');
            }

            $result = $this->service->modifyGuildMember($guildId, $userId, $data);

            return ToolResult::success([
                'ok' => true,
                'guild_id' => $guildId,
                'user_id' => $userId,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
