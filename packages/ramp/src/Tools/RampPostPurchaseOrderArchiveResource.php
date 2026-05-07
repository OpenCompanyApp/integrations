<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Archive a purchase order.
 *
 * Maps to the official Ramp endpoint post /developer/v1/purchase-orders/{purchase_order_id}/archive.
 */
class RampPostPurchaseOrderArchiveResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_purchase_order_archive_resource';
    protected const DESCRIPTION = 'Archive a purchase order

Official Ramp endpoint: POST /developer/v1/purchase-orders/{purchase_order_id}/archive';
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
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/purchase-orders/{purchase_order_id}/archive';
    protected const PATH_PARAMS = array (
  'purchase_order_id' => 'purchase_order_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
