<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Get a guild member.
 *
 * Retrieves one member object from a Discord guild.
 */
class DiscordGetGuildMember extends AbstractDiscordTool
{
    protected const NAME = 'discord_get_guild_member';
    protected const DESCRIPTION = 'Get one member from a Discord guild.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/guilds/{guild_id}/members/{user_id}';
    protected const REQUIRED = ['guild_id', 'user_id'];
}
