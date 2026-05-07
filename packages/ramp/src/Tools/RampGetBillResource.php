<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a bill.
 *
 * Maps to the official Ramp endpoint get /developer/v1/bills/{bill_id}.
 */
class RampGetBillResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_bill_resource';
    protected const DESCRIPTION = 'Fetch a bill

Official Ramp endpoint: GET /developer/v1/bills/{bill_id}';
    protected const PARAMETERS = array (
  'bill_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bill_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/bills/{bill_id}';
    protected const PATH_PARAMS = array (
  'bill_id' => 'bill_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
