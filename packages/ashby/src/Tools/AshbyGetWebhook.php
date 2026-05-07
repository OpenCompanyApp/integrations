<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Get an Ashby webhook setting. */
class AshbyGetWebhook extends AbstractAshbyTool
{
    protected const NAME = 'ashby_get_webhook';
    protected const DESCRIPTION = 'Fetch information for a specific Ashby webhook setting.';
    protected const ENDPOINT = '/webhook.info';
    protected const REQUIRED = ['webhookId'];
    protected const BODY_KEYS = ['webhookId'];
    protected const PARAMETERS = [
        'webhookId' => ['type' => 'string', 'required' => true, 'description' => 'Webhook setting UUID.'],
    ];
}
