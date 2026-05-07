<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Link purchase orders or documents to a vendor agreement.
 *
 * Maps to the official Ramp endpoint post /developer/v1/vendors/agreements/{agreement_id}/link.
 */
class RampPostVendorAgreementLinkResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_vendor_agreement_link_resource';
    protected const DESCRIPTION = 'Link purchase orders or documents to a vendor agreement

Official Ramp endpoint: POST /developer/v1/vendors/agreements/{agreement_id}/link';
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
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/vendors/agreements/{agreement_id}/link';
    protected const PATH_PARAMS = array (
  'agreement_id' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
