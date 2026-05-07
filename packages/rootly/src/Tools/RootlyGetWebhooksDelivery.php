<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a webhook delivery.
 *
 * Maps to the official Rootly endpoint get /v1/webhooks/deliveries/{id}.
 */
class RootlyGetWebhooksDelivery extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_webhooks_delivery';
    protected const DESCRIPTION = 'Retrieves a webhook delivery

Official Rootly endpoint: GET /v1/webhooks/deliveries/{id}

Retrieves a specific webhook delivery by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/webhooks/deliveries/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
