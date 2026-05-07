<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete a single line item from an existing purchase order.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/purchase-orders/{purchase_order_id}/line-items/{line_item_id}.
 */
class RampDeletePurchaseOrderLineItemSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_purchase_order_line_item_single_resource';
    protected const DESCRIPTION = 'Delete a single line item from an existing purchase order

Official Ramp endpoint: DELETE /developer/v1/purchase-orders/{purchase_order_id}/line-items/{line_item_id}

Purchase order must be approved.';
    protected const PARAMETERS = array (
  'purchase_order_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `purchase_order_id` from the official Ramp API operation.',
  ),
  'line_item_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `line_item_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/purchase-orders/{purchase_order_id}/line-items/{line_item_id}';
    protected const PATH_PARAMS = array (
  'purchase_order_id' => 'purchase_order_id',
  'line_item_id' => 'line_item_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
