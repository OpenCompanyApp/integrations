<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a purchase order.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/purchase-orders/{purchase_order_id}.
 */
class RampPatchPurchaseOrderSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_purchase_order_single_resource';
    protected const DESCRIPTION = 'Update a purchase order

Official Ramp endpoint: PATCH /developer/v1/purchase-orders/{purchase_order_id}

Purchase order must be approved.';
    protected const PARAMETERS = array (
  'purchase_order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `purchase_order_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/purchase-orders/{purchase_order_id}';
    protected const PATH_PARAMS = array (
  'purchase_order_id' => 'purchase_order_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
