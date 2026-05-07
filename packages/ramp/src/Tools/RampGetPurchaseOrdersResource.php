<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List purchase orders.
 *
 * Maps to the official Ramp endpoint get /developer/v1/purchase-orders.
 */
class RampGetPurchaseOrdersResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_purchase_orders_resource';
    protected const DESCRIPTION = 'List purchase orders

Official Ramp endpoint: GET /developer/v1/purchase-orders';
    protected const PARAMETERS = array (
  'creation_source' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `creation_source` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'ACCOUNTING_PROVIDER',
      1 => 'DEVELOPER_API',
      2 => 'EXTERNAL_IMPORT',
      3 => 'RAMP',
    ),
  ),
  'from_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `from_created_at` from the official Ramp API operation.',
  ),
  'to_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `to_created_at` from the official Ramp API operation.',
  ),
  'external_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `external_id` from the official Ramp API operation.',
  ),
  'remote_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `remote_id` from the official Ramp API operation.',
  ),
  'receipt_status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `receipt_status` from the official Ramp API operation.',
    'enum' =>
    array (
      0 => 'FULLY_RECEIVED',
      1 => 'NOT_RECEIVED',
      2 => 'OVER_RECEIVED',
      3 => 'PARTIALLY_RECEIVED',
    ),
  ),
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
  'spend_request_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `spend_request_id` from the official Ramp API operation.',
  ),
  'three_way_match_enabled' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `three_way_match_enabled` from the official Ramp API operation.',
  ),
  'include_archived' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `include_archived` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/purchase-orders';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'creation_source' => 'creation_source',
  'from_created_at' => 'from_created_at',
  'to_created_at' => 'to_created_at',
  'external_id' => 'external_id',
  'remote_id' => 'remote_id',
  'receipt_status' => 'receipt_status',
  'start' => 'start',
  'page_size' => 'page_size',
  'entity_id' => 'entity_id',
  'spend_request_id' => 'spend_request_id',
  'three_way_match_enabled' => 'three_way_match_enabled',
  'include_archived' => 'include_archived',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
