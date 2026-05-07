<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/** Create an Ashby webhook setting. */
class AshbyCreateWebhook extends AbstractAshbyTool
{
    protected const NAME = 'ashby_create_webhook';
    protected const DESCRIPTION = 'Create an Ashby webhook setting.';
    protected const ENDPOINT = '/webhook.create';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw webhook.create body.'],
    ];
}
