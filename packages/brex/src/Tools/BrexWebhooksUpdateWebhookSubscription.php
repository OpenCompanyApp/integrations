<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Update Webhook.
 *
 * Maps to the official Brex endpoint put /v1/webhooks/{id}.
 */
class BrexWebhooksUpdateWebhookSubscription extends AbstractBrexTool
{
    protected const NAME = 'brex_webhooks_update_webhook_subscription';
    protected const DESCRIPTION = 'Update Webhook

Official Brex endpoint: PUT /v1/webhooks/{id}

Update a webhook. You can update the endpoint url, event types that the endpoint receives, or temporarily deactivate the webhook.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v1/webhooks/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
