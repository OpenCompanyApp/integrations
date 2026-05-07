<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Delete a Discord message.
 *
 * Removes one message from a channel.
 */
class DiscordDeleteMessage extends AbstractDiscordTool
{
    protected const NAME = 'discord_delete_message';
    protected const DESCRIPTION = 'Delete one Discord message from a channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/channels/{channel_id}/messages/{message_id}';
    protected const REQUIRED = ['channel_id', 'message_id'];
}
