<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * List guild invites.
 *
 * Retrieves active invites for a Discord guild.
 */
class DiscordListGuildInvites extends AbstractDiscordTool
{
    protected const NAME = 'discord_list_guild_invites';
    protected const DESCRIPTION = 'List invites for a Discord guild.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/guilds/{guild_id}/invites';
    protected const REQUIRED = ['guild_id'];
}
