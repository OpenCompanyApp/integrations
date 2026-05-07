<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Create a guild channel.
 *
 * Supports common Discord channel create fields and raw body passthrough.
 */
class DiscordCreateGuildChannel extends AbstractDiscordTool
{
    protected const NAME = 'discord_create_guild_channel';
    protected const DESCRIPTION = 'Create a Discord guild channel. Provide name, type, topic, parent_id, permission_overwrites, or raw body.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Channel name.'],
        'type' => ['type' => 'integer', 'description' => 'Discord channel type.'],
        'topic' => ['type' => 'string', 'description' => 'Channel topic.'],
        'parent_id' => ['type' => 'string', 'description' => 'Parent category ID.'],
        'permission_overwrites' => ['type' => 'array', 'description' => 'Permission overwrites array.'],
        'body' => ['type' => 'object', 'description' => 'Raw Discord channel create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/guilds/{guild_id}/channels';
    protected const REQUIRED = ['guild_id', 'name'];
    protected const BODY_KEYS = ['name', 'type', 'topic', 'parent_id', 'permission_overwrites'];
    protected const BODY_REQUIRED = true;
}
