<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Get a Discord webhook.
 *
 * Retrieves webhook metadata by webhook ID.
 */
class DiscordGetWebhook extends AbstractDiscordTool
{
    protected const NAME = 'discord_get_webhook';
    protected const DESCRIPTION = 'Get a Discord webhook by webhook_id.';
    protected const PARAMETERS = [
        'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/webhooks/{webhook_id}';
    protected const REQUIRED = ['webhook_id'];
}
