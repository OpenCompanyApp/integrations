<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * List channel webhooks.
 *
 * Retrieves webhooks configured for one channel.
 */
class DiscordListChannelWebhooks extends AbstractDiscordTool
{
    protected const NAME = 'discord_list_channel_webhooks';
    protected const DESCRIPTION = 'List webhooks for a Discord channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/channels/{channel_id}/webhooks';
    protected const REQUIRED = ['channel_id'];
}
