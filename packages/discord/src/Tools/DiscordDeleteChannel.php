<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Delete or close a Discord channel.
 *
 * For guild channels this deletes the channel; for DM channels it closes the DM.
 */
class DiscordDeleteChannel extends AbstractDiscordTool
{
    protected const NAME = 'discord_delete_channel';
    protected const DESCRIPTION = 'Delete a Discord guild channel or close a DM channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/channels/{channel_id}';
    protected const REQUIRED = ['channel_id'];
}
