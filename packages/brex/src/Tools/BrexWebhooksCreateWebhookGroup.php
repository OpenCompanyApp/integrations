<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create Webhook Group.
 *
 * Maps to the official Brex endpoint post /v1/webhooks/groups.
 */
class BrexWebhooksCreateWebhookGroup extends AbstractBrexTool
{
    protected const NAME = 'brex_webhooks_create_webhook_group';
    protected const DESCRIPTION = 'Create Webhook Group

Official Brex endpoint: POST /v1/webhooks/groups

Creates a webhook group.';
    protected const PARAMETERS = array (
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Header parameter `Idempotency-Key` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/webhooks/groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}
