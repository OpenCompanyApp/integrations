<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a Webhook.
 *
 * Maps to the official Fivetran endpoint patch /v1/webhooks/{webhookId}.
 */
class FivetranModifyWebhook extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_webhook';
    protected const DESCRIPTION = 'Update a Webhook

Official Fivetran endpoint: PATCH /v1/webhooks/{webhookId}

The endpoint allows you to update the existing webhook with a given identifier';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
