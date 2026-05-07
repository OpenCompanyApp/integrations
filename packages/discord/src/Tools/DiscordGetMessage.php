<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Get a Discord message.
 *
 * Retrieves one message from a channel by message ID.
 */
class DiscordGetMessage extends AbstractDiscordTool
{
    protected const NAME = 'discord_get_message';
    protected const DESCRIPTION = 'Get one Discord message from a channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/channels/{channel_id}/messages/{message_id}';
    protected const REQUIRED = ['channel_id', 'message_id'];
}
