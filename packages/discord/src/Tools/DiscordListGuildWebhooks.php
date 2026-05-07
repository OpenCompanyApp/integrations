<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * List guild webhooks.
 *
 * Retrieves webhooks configured across a Discord guild.
 */
class DiscordListGuildWebhooks extends AbstractDiscordTool
{
    protected const NAME = 'discord_list_guild_webhooks';
    protected const DESCRIPTION = 'List webhooks for a Discord guild.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/guilds/{guild_id}/webhooks';
    protected const REQUIRED = ['guild_id'];
}
