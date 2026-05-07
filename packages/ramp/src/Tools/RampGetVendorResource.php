<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a vendor.
 *
 * Maps to the official Ramp endpoint get /developer/v1/vendors/{vendor_id}.
 */
class RampGetVendorResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_vendor_resource';
    protected const DESCRIPTION = 'Fetch a vendor

Official Ramp endpoint: GET /developer/v1/vendors/{vendor_id}';
    protected const PARAMETERS = array (
  'vendor_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/vendors/{vendor_id}';
    protected const PATH_PARAMS = array (
  'vendor_id' => 'vendor_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
