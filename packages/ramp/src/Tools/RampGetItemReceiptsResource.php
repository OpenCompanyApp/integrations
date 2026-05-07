<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List item receipts.
 *
 * Maps to the official Ramp endpoint get /developer/v1/item-receipts.
 */
class RampGetItemReceiptsResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_item_receipts_resource';
    protected const DESCRIPTION = 'List item receipts

Official Ramp endpoint: GET /developer/v1/item-receipts';
    protected const PARAMETERS = array (
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
  'entity_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `entity_id` from the official Ramp API operation.',
  ),
  'purchase_order_line_item_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `purchase_order_line_item_id` from the official Ramp API operation.',
  ),
  'purchase_order_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `purchase_order_id` from the official Ramp API operation.',
  ),
  'include_archived' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_archived` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/item-receipts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'start' => 'start',
  'page_size' => 'page_size',
  'entity_id' => 'entity_id',
  'purchase_order_line_item_id' => 'purchase_order_line_item_id',
  'purchase_order_id' => 'purchase_order_id',
  'include_archived' => 'include_archived',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
