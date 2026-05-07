<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a vendor agreement.
 *
 * Maps to the official Ramp endpoint get /developer/v1/vendors/agreements/{agreement_id}.
 */
class RampGetVendorAgreementResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_vendor_agreement_resource';
    protected const DESCRIPTION = 'Fetch a vendor agreement

Official Ramp endpoint: GET /developer/v1/vendors/agreements/{agreement_id}';
    protected const PARAMETERS = array (
  'agreement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `agreement_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/vendors/agreements/{agreement_id}';
    protected const PATH_PARAMS = array (
  'agreement_id' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
