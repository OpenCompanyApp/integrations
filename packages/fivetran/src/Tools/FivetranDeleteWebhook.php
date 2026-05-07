<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a Webhook.
 *
 * Maps to the official Fivetran endpoint delete /v1/webhooks/{webhookId}.
 */
class FivetranDeleteWebhook extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_webhook';
    protected const DESCRIPTION = 'Delete a Webhook

Official Fivetran endpoint: DELETE /v1/webhooks/{webhookId}

This endpoint allows you to delete an existing webhook with a given identifier';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `webhookId` from the official Fivetran API operation. The webhook ID',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/webhooks/{webhookId}';
    protected const PATH_PARAMS = array (
  'webhookId' => 'webhook_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
