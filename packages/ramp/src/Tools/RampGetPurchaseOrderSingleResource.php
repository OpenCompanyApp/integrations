<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a purchase order.
 *
 * Maps to the official Ramp endpoint get /developer/v1/purchase-orders/{purchase_order_id}.
 */
class RampGetPurchaseOrderSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_purchase_order_single_resource';
    protected const DESCRIPTION = 'Fetch a purchase order

Official Ramp endpoint: GET /developer/v1/purchase-orders/{purchase_order_id}';
    protected const PARAMETERS = array (
  'purchase_order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `purchase_order_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/purchase-orders/{purchase_order_id}';
    protected const PATH_PARAMS = array (
  'purchase_order_id' => 'purchase_order_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
