<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete inventory item accounting field.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/accounting/inventory-item.
 */
class RampDeleteInventoryItemFieldListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_inventory_item_field_list_resource';
    protected const DESCRIPTION = 'Delete inventory item accounting field

Official Ramp endpoint: DELETE /developer/v1/accounting/inventory-item';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/accounting/inventory-item';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
