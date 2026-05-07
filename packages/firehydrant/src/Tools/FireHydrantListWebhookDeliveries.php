<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List webhook deliveries.
 *
 * Maps to the official FireHydrant endpoint get /v1/webhooks/{webhook_id}/deliveries.
 */
class FireHydrantListWebhookDeliveries extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_webhook_deliveries';
    protected const DESCRIPTION = 'List webhook deliveries

Official FireHydrant endpoint: GET /v1/webhooks/{webhook_id}/deliveries

Get webhook deliveries';
    protected const PARAMETERS = array (
  'webhook_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of a webhook',
    'required' => true,
  ),
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks/{webhook_id}/deliveries';
    protected const PATH_PARAMS = array (
  'webhook_id' => 'webhook_id',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
