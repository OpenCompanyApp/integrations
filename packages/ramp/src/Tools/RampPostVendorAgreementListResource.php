<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * List vendor agreements.
 *
 * Maps to the official Ramp endpoint post /developer/v1/vendors/agreements.
 */
class RampPostVendorAgreementListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_vendor_agreement_list_resource';
    protected const DESCRIPTION = 'List vendor agreements

Official Ramp endpoint: POST /developer/v1/vendors/agreements';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/vendors/agreements';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
