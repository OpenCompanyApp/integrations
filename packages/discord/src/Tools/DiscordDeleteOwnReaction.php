<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Delete the current user's reaction.
 *
 * Removes the authenticated actor's reaction from a message.
 */
class DiscordDeleteOwnReaction extends AbstractDiscordTool
{
    protected const NAME = 'discord_delete_own_reaction';
    protected const DESCRIPTION = 'Delete the current user or bot reaction from a Discord message.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        'emoji' => ['type' => 'string', 'required' => true, 'description' => 'Emoji identifier.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/channels/{channel_id}/messages/{message_id}/reactions/{emoji}/@me';
    protected const REQUIRED = ['channel_id', 'message_id', 'emoji'];
}
