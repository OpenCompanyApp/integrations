<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Unlink purchase orders or documents from a vendor agreement.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/vendors/agreements/{agreement_id}/unlink.
 */
class RampDeleteVendorAgreementUnlinkResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_vendor_agreement_unlink_resource';
    protected const DESCRIPTION = 'Unlink purchase orders or documents from a vendor agreement

Official Ramp endpoint: DELETE /developer/v1/vendors/agreements/{agreement_id}/unlink';
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
    protected const METHOD = 'delete';
    protected const PATH = '/developer/v1/vendors/agreements/{agreement_id}/unlink';
    protected const PATH_PARAMS = array (
  'agreement_id' => 'agreement_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
