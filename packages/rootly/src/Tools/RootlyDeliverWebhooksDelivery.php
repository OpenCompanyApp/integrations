<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retries a webhook delivery.
 *
 * Maps to the official Rootly endpoint post /v1/webhooks/deliveries/{id}/deliver.
 */
class RootlyDeliverWebhooksDelivery extends AbstractRootlyTool
{
    protected const NAME = 'rootly_deliver_webhooks_delivery';
    protected const DESCRIPTION = 'Retries a webhook delivery

Official Rootly endpoint: POST /v1/webhooks/deliveries/{id}/deliver

Retries a webhook delivery';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/webhooks/deliveries/{id}/deliver';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
