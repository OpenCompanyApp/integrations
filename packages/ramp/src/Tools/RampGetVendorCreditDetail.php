<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a vendor credit.
 *
 * Maps to the official Ramp endpoint get /developer/v1/vendors/credits/{vendor_credit_id}.
 */
class RampGetVendorCreditDetail extends AbstractRampTool
{
    protected const NAME = 'ramp_get_vendor_credit_detail';
    protected const DESCRIPTION = 'Fetch a vendor credit

Official Ramp endpoint: GET /developer/v1/vendors/credits/{vendor_credit_id}';
    protected const PARAMETERS = array (
  'vendor_credit_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_credit_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/vendors/credits/{vendor_credit_id}';
    protected const PATH_PARAMS = array (
  'vendor_credit_id' => 'vendor_credit_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
