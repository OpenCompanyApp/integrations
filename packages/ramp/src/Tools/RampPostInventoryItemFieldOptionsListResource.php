<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload inventory item options.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/inventory-item/options.
 */
class RampPostInventoryItemFieldOptionsListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_inventory_item_field_options_list_resource';
    protected const DESCRIPTION = 'Upload inventory item options

Official Ramp endpoint: POST /developer/v1/accounting/inventory-item/options

There must be an active inventory item accounting field for the accounting connection.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/inventory-item/options';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
