<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch an item receipt.
 *
 * Maps to the official Ramp endpoint get /developer/v1/item-receipts/{item_receipt_id}.
 */
class RampGetItemReceiptSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_item_receipt_single_resource';
    protected const DESCRIPTION = 'Fetch an item receipt

Official Ramp endpoint: GET /developer/v1/item-receipts/{item_receipt_id}';
    protected const PARAMETERS = array (
  'item_receipt_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `item_receipt_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/item-receipts/{item_receipt_id}';
    protected const PATH_PARAMS = array (
  'item_receipt_id' => 'item_receipt_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
