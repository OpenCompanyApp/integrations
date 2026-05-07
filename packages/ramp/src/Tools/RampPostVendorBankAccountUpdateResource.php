<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Add to a vendor's bank account details.
 *
 * Maps to the official Ramp endpoint post /developer/v1/vendors/{vendor_id}/update-bank-accounts.
 */
class RampPostVendorBankAccountUpdateResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_vendor_bank_account_update_resource';
    protected const DESCRIPTION = 'Add to a vendor\'s bank account details

Official Ramp endpoint: POST /developer/v1/vendors/{vendor_id}/update-bank-accounts

Adds payment details for the vendor through the approval workflow. The proposal may require approval depending on the business\'s approval policies. Supported payment methods: - ACH: US bank account with routing and account numbers - Wire: US wire transfer with routing and account numbers';
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
    protected const PATH = '/developer/v1/vendors/{vendor_id}/update-bank-accounts';
    protected const PATH_PARAMS = array (
  'vendor_id' => 'vendor_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
