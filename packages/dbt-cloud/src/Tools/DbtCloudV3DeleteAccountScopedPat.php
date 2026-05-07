<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Delete Account Scoped PAT.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/users/{user_id}/account-apikeys/{id}/.
 */
class DbtCloudV3DeleteAccountScopedPat extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_delete_account_scoped_pat';
    protected const DESCRIPTION = 'Delete Account Scoped PAT

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/users/{user_id}/account-apikeys/{id}/';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'id' =>
  array (
    'type' => 'integer',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'user_id' =>
  array (
    'type' => 'integer',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v3/accounts/{account_id}/users/{user_id}/account-apikeys/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
