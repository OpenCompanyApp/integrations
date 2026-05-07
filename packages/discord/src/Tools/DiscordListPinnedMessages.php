<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * List pinned messages.
 *
 * Retrieves messages pinned in a Discord channel.
 */
class DiscordListPinnedMessages extends AbstractDiscordTool
{
    protected const NAME = 'discord_list_pinned_messages';
    protected const DESCRIPTION = 'List pinned messages in a Discord channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/channels/{channel_id}/pins';
    protected const REQUIRED = ['channel_id'];
}
