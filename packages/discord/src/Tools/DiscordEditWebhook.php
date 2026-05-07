<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Edit a Discord webhook.
 *
 * Updates webhook metadata such as name, avatar, or channel.
 */
class DiscordEditWebhook extends AbstractDiscordTool
{
    protected const NAME = 'discord_edit_webhook';
    protected const DESCRIPTION = 'Edit a Discord webhook. Provide name, avatar, channel_id, or raw body.';
    protected const PARAMETERS = [
        'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
        'name' => ['type' => 'string', 'description' => 'Webhook name.'],
        'avatar' => ['type' => 'string', 'description' => 'Base64 avatar image data.'],
        'channel_id' => ['type' => 'string', 'description' => 'Target channel ID.'],
        'body' => ['type' => 'object', 'description' => 'Raw Discord webhook edit body.'],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/webhooks/{webhook_id}';
    protected const REQUIRED = ['webhook_id'];
    protected const BODY_KEYS = ['name', 'avatar', 'channel_id'];
    protected const BODY_REQUIRED = true;
}
