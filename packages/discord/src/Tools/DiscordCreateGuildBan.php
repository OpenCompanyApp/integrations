<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Ban a user from a guild.
 *
 * Supports delete message seconds and raw body passthrough.
 */
class DiscordCreateGuildBan extends AbstractDiscordTool
{
    protected const NAME = 'discord_create_guild_ban';
    protected const DESCRIPTION = 'Ban a user from a Discord guild.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'delete_message_seconds' => ['type' => 'integer', 'description' => 'Seconds of message history to delete.'],
        'body' => ['type' => 'object', 'description' => 'Raw Discord ban body.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/guilds/{guild_id}/bans/{user_id}';
    protected const REQUIRED = ['guild_id', 'user_id'];
    protected const BODY_KEYS = ['delete_message_seconds'];
}
