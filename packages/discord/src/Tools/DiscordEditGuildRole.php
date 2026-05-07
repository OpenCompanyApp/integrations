<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Edit a guild role.
 *
 * Updates a Discord role with common role fields or raw body passthrough.
 */
class DiscordEditGuildRole extends AbstractDiscordTool
{
    protected const NAME = 'discord_edit_guild_role';
    protected const DESCRIPTION = 'Edit a Discord guild role. Provide name, permissions, color, hoist, mentionable, or raw body.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'role_id' => ['type' => 'string', 'required' => true, 'description' => 'Role ID.'],
        'name' => ['type' => 'string', 'description' => 'Role name.'],
        'permissions' => ['type' => 'string', 'description' => 'Permission bitset as a string.'],
        'color' => ['type' => 'integer', 'description' => 'RGB integer color.'],
        'hoist' => ['type' => 'boolean', 'description' => 'Whether role is displayed separately.'],
        'mentionable' => ['type' => 'boolean', 'description' => 'Whether role is mentionable.'],
        'body' => ['type' => 'object', 'description' => 'Raw Discord role edit body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/guilds/{guild_id}/roles/{role_id}';
    protected const REQUIRED = ['guild_id', 'role_id'];
    protected const BODY_KEYS = ['name', 'permissions', 'color', 'hoist', 'mentionable'];
    protected const BODY_REQUIRED = true;
}
