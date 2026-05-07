<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Edit a Discord channel.
 *
 * Sends a PATCH request with changed channel fields.
 */
class DiscordEditChannel extends AbstractDiscordTool
{
    protected const NAME = 'discord_edit_channel';
    protected const DESCRIPTION = 'Edit a Discord channel using PATCH /channels/{channel_id}. Pass changed fields or raw body.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'name' => ['type' => 'string', 'description' => 'Channel name.'],
        'topic' => ['type' => 'string', 'description' => 'Channel topic.'],
        'position' => ['type' => 'integer', 'description' => 'Channel position.'],
        'parent_id' => ['type' => 'string', 'description' => 'Parent category ID.'],
        'body' => ['type' => 'object', 'description' => 'Raw Discord channel update body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/channels/{channel_id}';
    protected const REQUIRED = ['channel_id'];
    protected const BODY_KEYS = ['name', 'topic', 'position', 'parent_id'];
    protected const BODY_REQUIRED = true;
}
