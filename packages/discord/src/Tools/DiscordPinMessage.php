<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Pin a Discord message.
 *
 * Adds one message to the channel's pinned messages.
 */
class DiscordPinMessage extends AbstractDiscordTool
{
    protected const NAME = 'discord_pin_message';
    protected const DESCRIPTION = 'Pin one Discord message in a channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/channels/{channel_id}/pins/{message_id}';
    protected const REQUIRED = ['channel_id', 'message_id'];
}
