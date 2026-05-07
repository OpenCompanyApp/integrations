<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * List guild members.
 *
 * Retrieves members from a guild with limit and after pagination.
 */
class DiscordListGuildMembers extends AbstractDiscordTool
{
    protected const NAME = 'discord_list_guild_members';
    protected const DESCRIPTION = 'List members in a Discord guild.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'limit' => ['type' => 'integer', 'description' => 'Number of members to return.'],
        'after' => ['type' => 'string', 'description' => 'User ID cursor.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/guilds/{guild_id}/members';
    protected const REQUIRED = ['guild_id'];
    protected const QUERY_KEYS = ['limit', 'after'];
}
