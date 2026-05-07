<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch inventory item accounting field.
 *
 * Maps to the official Ramp endpoint get /developer/v1/accounting/inventory-item.
 */
class RampGetInventoryItemFieldListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_inventory_item_field_list_resource';
    protected const DESCRIPTION = 'Fetch inventory item accounting field

Official Ramp endpoint: GET /developer/v1/accounting/inventory-item

Returns the inventory item accounting field for the current accounting connection.';
    protected const PARAMETERS = array (
  'accounting_connection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `accounting_connection_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/accounting/inventory-item';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'accounting_connection_id' => 'accounting_connection_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
