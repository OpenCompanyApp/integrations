<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Unregister Webhook.
 *
 * Maps to the official Brex endpoint delete /v1/webhooks/{id}.
 */
class BrexWebhooksDeleteWebhookSubscription extends AbstractBrexTool
{
    protected const NAME = 'brex_webhooks_delete_webhook_subscription';
    protected const DESCRIPTION = 'Unregister Webhook

Official Brex endpoint: DELETE /v1/webhooks/{id}

Unregister a webhook if you want to stop receiving webhook events';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/webhooks/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
