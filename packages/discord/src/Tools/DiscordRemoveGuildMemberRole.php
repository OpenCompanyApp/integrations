<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Remove a role from a guild member.
 *
 * Uses Discord's member role remove endpoint.
 */
class DiscordRemoveGuildMemberRole extends AbstractDiscordTool
{
    protected const NAME = 'discord_remove_guild_member_role';
    protected const DESCRIPTION = 'Remove a role from a Discord guild member.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'role_id' => ['type' => 'string', 'required' => true, 'description' => 'Role ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/guilds/{guild_id}/members/{user_id}/roles/{role_id}';
    protected const REQUIRED = ['guild_id', 'user_id', 'role_id'];
}
