<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Create a guild role.
 *
 * Creates a Discord role with common role fields or raw body passthrough.
 */
class DiscordCreateGuildRole extends AbstractDiscordTool
{
    protected const NAME = 'discord_create_guild_role';
    protected const DESCRIPTION = 'Create a Discord guild role. Provide name, permissions, color, hoist, mentionable, or raw body.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'name' => ['type' => 'string', 'description' => 'Role name.'],
        'permissions' => ['type' => 'string', 'description' => 'Permission bitset as a string.'],
        'color' => ['type' => 'integer', 'description' => 'RGB integer color.'],
        'hoist' => ['type' => 'boolean', 'description' => 'Whether role is displayed separately.'],
        'mentionable' => ['type' => 'boolean', 'description' => 'Whether role is mentionable.'],
        'body' => ['type' => 'object', 'description' => 'Raw Discord role create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/guilds/{guild_id}/roles';
    protected const REQUIRED = ['guild_id'];
    protected const BODY_KEYS = ['name', 'permissions', 'color', 'hoist', 'mentionable'];
}
