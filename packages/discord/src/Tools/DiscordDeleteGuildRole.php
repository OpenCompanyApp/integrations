<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Delete a guild role.
 *
 * Removes a role from a Discord guild.
 */
class DiscordDeleteGuildRole extends AbstractDiscordTool
{
    protected const NAME = 'discord_delete_guild_role';
    protected const DESCRIPTION = 'Delete a Discord guild role.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'role_id' => ['type' => 'string', 'required' => true, 'description' => 'Role ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/guilds/{guild_id}/roles/{role_id}';
    protected const REQUIRED = ['guild_id', 'role_id'];
}
