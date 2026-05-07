<?php

namespace OpenCompany\Integrations\Ramp\Tools;

/**
 * Upload general ledger accounts.
 *
 * Maps to the official Ramp endpoint post /developer/v1/accounting/accounts.
 */
class RampPostGlAccountListResource extends AbstractRampTool
{
    protected const NAME = 'ramp_post_gl_account_list_resource';
    protected const DESCRIPTION = 'Upload general ledger accounts

Official Ramp endpoint: POST /developer/v1/accounting/accounts

You can upload up to 500 general ledger accounts in an all-or-nothing fashion. If a general ledger accounts within a batch is malformed or violates a database constraint, the entire batch containing that account will be disregarded. To have a successful upload, please sanitize the data and ensure the general ledger accounts that you are trying to upload do not already exist on Ramp. If a general ledger account is already on Ramp but you want to update its attributes, please use the PATCH developer/v1/accounting/accounts/{id} endpoint instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Ramp OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/developer/v1/accounting/accounts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
