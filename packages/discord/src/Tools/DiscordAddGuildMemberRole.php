<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Add a role to a guild member.
 *
 * Uses Discord's idempotent member role add endpoint.
 */
class DiscordAddGuildMemberRole extends AbstractDiscordTool
{
    protected const NAME = 'discord_add_guild_member_role';
    protected const DESCRIPTION = 'Add a role to a Discord guild member.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'role_id' => ['type' => 'string', 'required' => true, 'description' => 'Role ID.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/guilds/{guild_id}/members/{user_id}/roles/{role_id}';
    protected const REQUIRED = ['guild_id', 'user_id', 'role_id'];
}
