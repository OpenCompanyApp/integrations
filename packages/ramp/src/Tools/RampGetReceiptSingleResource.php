<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a receipt.
 *
 * Maps to the official Ramp endpoint get /developer/v1/receipts/{receipt_id}.
 */
class RampGetReceiptSingleResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_receipt_single_resource';
    protected const DESCRIPTION = 'Fetch a receipt

Official Ramp endpoint: GET /developer/v1/receipts/{receipt_id}';
    protected const PARAMETERS = array (
  'receipt_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `receipt_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/receipts/{receipt_id}';
    protected const PATH_PARAMS = array (
  'receipt_id' => 'receipt_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
