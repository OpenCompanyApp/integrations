<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * List Webhook Endpoints.
 *
 * Maps to the official WorkOS endpoint get /webhook_endpoints.
 */
class WorkOSWebhookEndpointsList extends AbstractWorkOSTool
{
    protected const NAME = 'workos_webhook_endpoints_list';
    protected const DESCRIPTION = 'List Webhook Endpoints

Official WorkOS endpoint: GET /webhook_endpoints

Get a list of all of your existing webhook endpoints.';
    protected const PARAMETERS = array (
  'before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `before` from the official WorkOS API operation.',
  ),
  'after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `after` from the official WorkOS API operation.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official WorkOS API operation.',
  ),
  'order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `order` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/webhook_endpoints';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'after' => 'after',
  'limit' => 'limit',
  'order' => 'order',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
