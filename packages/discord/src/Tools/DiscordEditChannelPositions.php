<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Modify guild channel positions.
 *
 * Sends Discord's bulk channel position update body for a guild.
 */
class DiscordEditChannelPositions extends AbstractDiscordTool
{
    protected const NAME = 'discord_edit_channel_positions';
    protected const DESCRIPTION = 'Modify Discord guild channel positions. Pass positions as Discord channel position objects.';
    protected const PARAMETERS = [
        'guild_id' => ['type' => 'string', 'required' => true, 'description' => 'Guild ID.'],
        'positions' => ['type' => 'array', 'required' => true, 'description' => 'Array of Discord channel position objects.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/guilds/{guild_id}/channels';
    protected const REQUIRED = ['guild_id', 'positions'];
    protected const BODY_KEYS = ['positions'];
    protected const BODY_REQUIRED = true;
}
