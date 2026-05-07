<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete a vendor.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/vendors/{vendor_id}.
 */
class RampDeleteVendorResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_vendor_resource';
    protected const DESCRIPTION = 'Delete a vendor

Official Ramp endpoint: DELETE /developer/v1/vendors/{vendor_id}

A vendor cannot be deleted if it has associated transactions, bills, contracts, or spend requests.';
    protected const PARAMETERS = array (
  'vendor_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'delete';
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
