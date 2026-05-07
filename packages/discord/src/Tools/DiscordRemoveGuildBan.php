<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Remove a guild ban.
 *
 * Unbans one user from a Discord guild.
 */
class DiscordRemoveGuildBan extends AbstractDiscordTool
{
    protected const NAME = 'discord_remove_guild_ban';
    protected const DESCRIPTION = 'Remove a ban from a Discord guild.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/guilds/{guild_id}/bans/{user_id}';
    protected const REQUIRED = ['guild_id', 'user_id'];
}
