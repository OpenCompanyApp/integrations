<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * List Webhooks.
 *
 * Maps to the official Brex endpoint get /v1/webhooks.
 */
class BrexWebhooksListWebhookSubscriptions extends AbstractBrexTool
{
    protected const NAME = 'brex_webhooks_list_webhook_subscriptions';
    protected const DESCRIPTION = 'List Webhooks

Official Brex endpoint: GET /v1/webhooks

List the webhooks you have registered';
    protected const PARAMETERS = array (
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Brex API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'cursor' => 'cursor',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
