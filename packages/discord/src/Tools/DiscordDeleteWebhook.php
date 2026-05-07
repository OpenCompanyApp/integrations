<?php

namespace OpenCompany\Integrations\Discord\Tools;

/**
 * Delete a Discord webhook.
 *
 * Removes a webhook by webhook ID.
 */
class DiscordDeleteWebhook extends AbstractDiscordTool
{
    protected const NAME = 'discord_delete_webhook';
    protected const DESCRIPTION = 'Delete a Discord webhook by webhook_id.';
    protected const PARAMETERS = [
        'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/webhooks/{webhook_id}';
    protected const REQUIRED = ['webhook_id'];
}
