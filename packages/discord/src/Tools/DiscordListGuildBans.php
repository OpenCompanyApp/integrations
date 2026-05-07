<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * List guild bans.
 *
 * Retrieves ban objects with optional pagination.
 */
class DiscordListGuildBans extends AbstractDiscordTool
{
    protected const NAME = 'discord_list_guild_bans';
    protected const DESCRIPTION = 'List bans in a Discord guild.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Number of bans.'],
        'before' => ['type' => 'string', 'description' => 'User ID cursor.'],
        'after' => ['type' => 'string', 'description' => 'User ID cursor.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/guilds/{guild_id}/bans';
    protected const REQUIRED = ['guild_id'];
    protected const QUERY_KEYS = ['limit', 'before', 'after'];
}
