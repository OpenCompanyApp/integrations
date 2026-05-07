<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Create Account Scoped PAT.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/users/{user_id}/account-apikeys/.
 */
class DbtCloudV3CreateAccountScopedPat extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_create_account_scoped_pat';
    protected const DESCRIPTION = 'Create Account Scoped PAT

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/users/{user_id}/account-apikeys/';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'user_id' =>
  array (
    'type' => 'integer',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v3/accounts/{account_id}/users/{user_id}/account-apikeys/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
