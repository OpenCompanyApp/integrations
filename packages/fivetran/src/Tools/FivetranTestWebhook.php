<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Test a Webhook.
 *
 * Maps to the official Fivetran endpoint post /v1/webhooks/{webhookId}/test.
 */
class FivetranTestWebhook extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_test_webhook';
    protected const DESCRIPTION = 'Test a Webhook

Official Fivetran endpoint: POST /v1/webhooks/{webhookId}/test

The endpoint allows you to test an existing webhook. It sends a webhook with a given identifier for a dummy connection with identifier _connection_1';
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/webhooks/{webhookId}/test';
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
