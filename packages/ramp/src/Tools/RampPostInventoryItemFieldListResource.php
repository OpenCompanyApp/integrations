<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a new inventory item accounting field.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/inventory-item.
 */
class RampPostInventoryItemFieldListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_inventory_item_field_list_resource';
    protected const DESCRIPTION = 'Create a new inventory item accounting field

Official Ramp endpoint: POST /developer/v1/accounting/inventory-item

There can only be one active inventory item accounting field per accounting connection.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/inventory-item';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
