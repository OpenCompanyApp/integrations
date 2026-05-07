<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List vendor contacts for vendor.
 *
 * Maps to the official Ramp endpoint get /developer/v1/vendors/{vendor_id}/contacts.
 */
class RampGetVendorContactListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_vendor_contact_list_resource';
    protected const DESCRIPTION = 'List vendor contacts for vendor

Official Ramp endpoint: GET /developer/v1/vendors/{vendor_id}/contacts';
    protected const PARAMETERS = array (
  'vendor_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_id` from the official Ramp API operation.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `start` from the official Ramp API operation.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page_size` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/vendors/{vendor_id}/contacts';
    protected const PATH_PARAMS = array (
  'vendor_id' => 'vendor_id',
);
    protected const QUERY_PARAMS = array (
  'start' => 'start',
  'page_size' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
