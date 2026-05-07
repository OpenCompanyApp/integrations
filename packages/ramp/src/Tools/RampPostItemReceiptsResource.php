<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create an item receipt.
 *
 * Maps to the official Ramp endpoint post /developer/v1/item-receipts.
 */
class RampPostItemReceiptsResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_item_receipts_resource';
    protected const DESCRIPTION = 'Create an item receipt

Official Ramp endpoint: POST /developer/v1/item-receipts';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/item-receipts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
