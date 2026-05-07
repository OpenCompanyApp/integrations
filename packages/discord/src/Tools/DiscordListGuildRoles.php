<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * List guild roles.
 *
 * Retrieves the role objects configured in a Discord guild.
 */
class DiscordListGuildRoles extends AbstractDiscordTool
{
    protected const NAME = 'discord_list_guild_roles';
    protected const DESCRIPTION = 'List roles in a Discord guild.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/guilds/{guild_id}/roles';
    protected const REQUIRED = ['guild_id'];
}
