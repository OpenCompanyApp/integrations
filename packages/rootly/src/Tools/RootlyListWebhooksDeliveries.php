<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List webhook deliveries.
 *
 * Maps to the official Rootly endpoint get /v1/webhooks/endpoints/{endpoint_id}/deliveries.
 */
class RootlyListWebhooksDeliveries extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_webhooks_deliveries';
    protected const DESCRIPTION = 'List webhook deliveries

Official Rootly endpoint: GET /v1/webhooks/endpoints/{endpoint_id}/deliveries

List webhook deliveries for given endpoint';
    protected const PARAMETERS = array (
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'endpoint_id' =>
  array (
    'type' => 'string',
    'description' => 'endpoint_id parameter.',
    'required' => true,
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks/endpoints/{endpoint_id}/deliveries';
    protected const PATH_PARAMS = array (
  'endpoint_id' => 'endpoint_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
