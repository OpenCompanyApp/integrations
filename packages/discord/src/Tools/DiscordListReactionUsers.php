<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * List users who reacted with an emoji.
 *
 * Supports Discord reaction pagination parameters.
 */
class DiscordListReactionUsers extends AbstractDiscordTool
{
    protected const NAME = 'discord_list_reaction_users';
    protected const DESCRIPTION = 'List users who reacted to a message with a specific emoji.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        'emoji' => ['type' => 'string', 'required' => true, 'description' => 'Emoji identifier.'],
        'after' => ['type' => 'string', 'description' => 'User ID cursor.'],
        'limit' => ['type' => 'integer', 'description' => 'Number of users.'],
        'type' => ['type' => 'integer', 'description' => 'Reaction type filter.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/channels/{channel_id}/messages/{message_id}/reactions/{emoji}';
    protected const REQUIRED = ['channel_id', 'message_id', 'emoji'];
    protected const QUERY_KEYS = ['after', 'limit', 'type'];
}
