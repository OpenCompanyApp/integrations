<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Kick a guild member.
 *
 * Removes a member from a Discord guild.
 */
class DiscordKickGuildMember extends AbstractDiscordTool
{
    protected const NAME = 'discord_kick_guild_member';
    protected const DESCRIPTION = 'Kick a member from a Discord guild.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/guilds/{guild_id}/members/{user_id}';
    protected const REQUIRED = ['guild_id', 'user_id'];
}
