<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Unpin a Discord message.
 *
 * Removes one message from the channel's pinned messages.
 */
class DiscordUnpinMessage extends AbstractDiscordTool
{
    protected const NAME = 'discord_unpin_message';
    protected const DESCRIPTION = 'Unpin one Discord message from a channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/channels/{channel_id}/pins/{message_id}';
    protected const REQUIRED = ['channel_id', 'message_id'];
}
