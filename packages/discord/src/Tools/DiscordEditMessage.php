<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Edit a Discord message.
 *
 * Supports content, embeds, components, flags, and raw body passthrough.
 */
class DiscordEditMessage extends AbstractDiscordTool
{
    protected const NAME = 'discord_edit_message';
    protected const DESCRIPTION = 'Edit a Discord message. Provide content, embeds, components, flags, or raw body.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID.'],
        'content' => ['type' => 'string', 'description' => 'New message content.'],
        'embeds' => ['type' => 'array', 'description' => 'Embed objects.'],
        'components' => ['type' => 'array', 'description' => 'Component objects.'],
        'flags' => ['type' => 'integer', 'description' => 'Message flags.'],
        'body' => ['type' => 'object', 'description' => 'Raw Discord edit message body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/channels/{channel_id}/messages/{message_id}';
    protected const REQUIRED = ['channel_id', 'message_id'];
    protected const BODY_KEYS = ['content', 'embeds', 'components', 'flags'];
    protected const BODY_REQUIRED = true;
}
