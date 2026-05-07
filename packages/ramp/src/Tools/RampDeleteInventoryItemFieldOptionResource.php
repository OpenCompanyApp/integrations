<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete an inventory item option.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/accounting/inventory-item/options/{option_id}.
 */
class RampDeleteInventoryItemFieldOptionResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_inventory_item_field_option_resource';
    protected const DESCRIPTION = 'Delete an inventory item option

Official Ramp endpoint: DELETE /developer/v1/accounting/inventory-item/options/{option_id}';
    protected const PARAMETERS = array (
  'option_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `option_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/accounting/inventory-item/options/{option_id}';
    protected const PATH_PARAMS = array (
  'option_id' => 'option_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
