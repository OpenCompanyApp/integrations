<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete a vendor agreement.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/vendors/agreements/{agreement_id}.
 */
class RampDeleteVendorAgreementResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_vendor_agreement_resource';
    protected const DESCRIPTION = 'Delete a vendor agreement

Official Ramp endpoint: DELETE /developer/v1/vendors/agreements/{agreement_id}';
    protected const PARAMETERS = array (
  'agreement_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `agreement_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'delete';
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
