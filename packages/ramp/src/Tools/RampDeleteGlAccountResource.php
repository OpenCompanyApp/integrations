<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Delete a general ledger account.
 *
 * Maps to the official Ramp endpoint delete /developer/v1/accounting/accounts/{gl_account_id}.
 */
class RampDeleteGlAccountResource extends AbstractRampTool
{
    protected const NAME = 'ramp_delete_gl_account_resource';
    protected const DESCRIPTION = 'Delete a general ledger account

Official Ramp endpoint: DELETE /developer/v1/accounting/accounts/{gl_account_id}';
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
    protected const METHOD = 'delete';
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
