<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Archive a vendor bank account.
 *
 * Maps to the official Ramp endpoint post /developer/v1/vendors/{vendor_id}/accounts/{bank_account_id}/archive.
 */
class RampPostVendorBankAccountArchiveResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_vendor_bank_account_archive_resource';
    protected const DESCRIPTION = 'Archive a vendor bank account

Official Ramp endpoint: POST /developer/v1/vendors/{vendor_id}/accounts/{bank_account_id}/archive

If the bank account has associated bills, drafts, or recurring templates, a replacement_bank_account_id must be provided in the request body.';
    protected const PARAMETERS = array (
  'vendor_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `vendor_id` from the official Ramp API operation.',
  ),
  'bank_account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bank_account_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/vendors/{vendor_id}/accounts/{bank_account_id}/archive';
    protected const PATH_PARAMS = array (
  'vendor_id' => 'vendor_id',
  'bank_account_id' => 'bank_account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
