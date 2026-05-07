<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Fetch a general ledger account.
 *
 * Maps to the official Ramp endpoint get /developer/v1/accounting/accounts/{gl_account_id}.
 */
class RampGetGlAccountResource extends AbstractRampTool
{
    protected const NAME = 'ramp_get_gl_account_resource';
    protected const DESCRIPTION = 'Fetch a general ledger account

Official Ramp endpoint: GET /developer/v1/accounting/accounts/{gl_account_id}';
    protected const PARAMETERS = array (
  'gl_account_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `gl_account_id` from the official Ramp API operation.',
  ),
  'accounting_connection_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `accounting_connection_id` from the official Ramp API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/developer/v1/accounting/accounts/{gl_account_id}';
    protected const PATH_PARAMS = array (
  'gl_account_id' => 'gl_account_id',
);
    protected const QUERY_PARAMS = array (
  'accounting_connection_id' => 'accounting_connection_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
