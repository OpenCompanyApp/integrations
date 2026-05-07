<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Edit a guild member.
 *
 * Updates roles, nickname, mute/deaf state, timeout, or channel assignment.
 */
class DiscordEditGuildMember extends AbstractDiscordTool
{
    protected const NAME = 'discord_edit_guild_member';
    protected const DESCRIPTION = 'Edit a Discord guild member. Pass nick, roles, mute, deaf, channel_id, communication_disabled_until, flags, or raw body.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'nick' => ['type' => 'string', 'description' => 'Member nickname.'],
        'roles' => ['type' => 'array', 'description' => 'Role IDs.'],
        'mute' => ['type' => 'boolean', 'description' => 'Voice mute state.'],
        'deaf' => ['type' => 'boolean', 'description' => 'Voice deaf state.'],
        'channel_id' => ['type' => 'string', 'description' => 'Voice channel ID or null in raw body.'],
        'communication_disabled_until' => ['type' => 'string', 'description' => 'Timeout expiration timestamp or null in raw body.'],
        'flags' => ['type' => 'integer', 'description' => 'Guild member flags.'],
        'body' => ['type' => 'object', 'description' => 'Raw Discord member edit body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/guilds/{guild_id}/members/{user_id}';
    protected const REQUIRED = ['guild_id', 'user_id'];
    protected const BODY_KEYS = ['nick', 'roles', 'mute', 'deaf', 'channel_id', 'communication_disabled_until', 'flags'];
    protected const BODY_REQUIRED = true;
}
