<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Account Scoped PATs.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/users/{user_id}/account-apikeys/.
 */
class DbtCloudV3ListAccountScopedPats extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_account_scoped_pats';
    protected const DESCRIPTION = 'List Account Scoped PATs

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/users/{user_id}/account-apikeys/';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
  'user_id' =>
  array (
    'type' => 'integer',
    'description' => 'user_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/users/{user_id}/account-apikeys/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'user_id' => 'user_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
