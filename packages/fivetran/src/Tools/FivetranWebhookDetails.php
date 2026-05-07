<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Retrieve Webhook Details.
 *
 * Maps to the official Fivetran endpoint get /v1/webhooks/{webhookId}.
 */
class FivetranWebhookDetails extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_webhook_details';
    protected const DESCRIPTION = 'Retrieve Webhook Details

Official Fivetran endpoint: GET /v1/webhooks/{webhookId}

This endpoint allows you to retrieve details of the existing webhook for a given identifier';
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
    protected const METHOD = 'get';
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
