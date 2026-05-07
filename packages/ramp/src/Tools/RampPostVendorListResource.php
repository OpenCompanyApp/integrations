<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a new vendor.
 *
 * Maps to the official Ramp endpoint post /developer/v1/vendors.
 */
class RampPostVendorListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_vendor_list_resource';
    protected const DESCRIPTION = 'Create a new vendor

Official Ramp endpoint: POST /developer/v1/vendors

Vendors created in the API are approved by default, and are not subject to existing approval policies.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/vendors';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
