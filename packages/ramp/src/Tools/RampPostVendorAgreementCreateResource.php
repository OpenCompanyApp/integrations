<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Create a vendor agreement.
 *
 * Maps to the official Ramp endpoint post /developer/v1/vendors/{vendor_id}/agreements.
 */
class RampPostVendorAgreementCreateResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_vendor_agreement_create_resource';
    protected const DESCRIPTION = 'Create a vendor agreement

Official Ramp endpoint: POST /developer/v1/vendors/{vendor_id}/agreements';
    protected const PARAMETERS = array (
  'vendor_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/vendors/{vendor_id}/agreements';
    protected const PATH_PARAMS = array (
  'vendor_id' => 'vendor_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
