<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Create a channel webhook.
 *
 * Creates a Discord webhook for a channel.
 */
class DiscordCreateWebhook extends AbstractDiscordTool
{
    protected const NAME = 'discord_create_webhook';
    protected const DESCRIPTION = 'Create a Discord webhook for a channel.';
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Webhook name.'],
        'avatar' => ['type' => 'string', 'description' => 'Base64 avatar image data.'],
        'body' => ['type' => 'object', 'description' => 'Raw Discord webhook create body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/channels/{channel_id}/webhooks';
    protected const REQUIRED = ['channel_id', 'name'];
    protected const BODY_KEYS = ['name', 'avatar'];
    protected const BODY_REQUIRED = true;
}
