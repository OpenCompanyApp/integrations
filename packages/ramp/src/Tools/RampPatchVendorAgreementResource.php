<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a vendor agreement.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/vendors/agreements/{agreement_id}.
 */
class RampPatchVendorAgreementResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_vendor_agreement_resource';
    protected const DESCRIPTION = 'Update a vendor agreement

Official Ramp endpoint: PATCH /developer/v1/vendors/agreements/{agreement_id}';
    protected const PARAMETERS = array (
  'agreement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `agreement_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/vendors/agreements/{agreement_id}';
    protected const PATH_PARAMS = array (
  'agreement_id' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
