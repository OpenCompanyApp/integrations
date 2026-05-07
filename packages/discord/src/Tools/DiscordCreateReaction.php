<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Add a reaction to a Discord message.
 *
 * Uses the current authenticated user or bot as the reacting actor.
 */
class DiscordCreateReaction extends AbstractDiscordTool
{
    protected const NAME = 'discord_create_reaction';
    protected const DESCRIPTION = 'Add a reaction to a Discord message. Emoji should be URL-safe name:id or unicode.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        'emoji' => ['type' => 'string', 'required' => true, 'description' => 'Emoji identifier, for example name:id or unicode emoji.'],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/channels/{channel_id}/messages/{message_id}/reactions/{emoji}/@me';
    protected const REQUIRED = ['channel_id', 'message_id', 'emoji'];
}
