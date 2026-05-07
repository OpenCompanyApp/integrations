<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Update a general ledger account.
 *
 * Maps to the official Ramp endpoint patch /developer/v1/accounting/accounts/{gl_account_id}.
 */
class RampPatchGlAccountResource extends AbstractRampTool
{
    protected const NAME = 'ramp_patch_gl_account_resource';
    protected const DESCRIPTION = 'Update a general ledger account

Official Ramp endpoint: PATCH /developer/v1/accounting/accounts/{gl_account_id}

This endpoint can be used to update the name or code of a GL account;';
    protected const PARAMETERS = array (
  'gl_account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `gl_account_id` from the official Ramp API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/developer/v1/accounting/accounts/{gl_account_id}';
    protected const PATH_PARAMS = array (
  'gl_account_id' => 'gl_account_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
