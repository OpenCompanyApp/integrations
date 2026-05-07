<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a purchase order.
 *
 * Maps to the official Ramp endpoint post /developer/v1/purchase-orders.
 */
class RampPostPurchaseOrdersResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_purchase_orders_resource';
    protected const DESCRIPTION = 'Create a purchase order

Official Ramp endpoint: POST /developer/v1/purchase-orders';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/purchase-orders';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
