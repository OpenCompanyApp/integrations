<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List inventory item options.
 *
 * Maps to the official Ramp endpoint get /developer/v1/accounting/inventory-item/options.
 */
class RampGetInventoryItemFieldOptionsListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_inventory_item_field_options_list_resource';
    protected const DESCRIPTION = 'List inventory item options

Official Ramp endpoint: GET /developer/v1/accounting/inventory-item/options';
    protected const PARAMETERS = array (
  'remote_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `remote_id` from the official Ramp API operation.',
  ),
  'is_active' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_active` from the official Ramp API operation.',
  ),
  'code' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `code` from the official Ramp API operation.',
  ),
  'accounting_connection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `accounting_connection_id` from the official Ramp API operation.',
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
  'is_synced' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_synced` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/accounting/inventory-item/options';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'remote_id' => 'remote_id',
  'is_active' => 'is_active',
  'code' => 'code',
  'accounting_connection_id' => 'accounting_connection_id',
  'start' => 'start',
  'page_size' => 'page_size',
  'is_synced' => 'is_synced',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
