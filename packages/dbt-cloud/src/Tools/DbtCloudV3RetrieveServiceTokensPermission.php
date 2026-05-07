<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Service Tokens Permission.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/service-tokens/{service_token_id}/permissions/.
 */
class DbtCloudV3RetrieveServiceTokensPermission extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_retrieve_service_tokens_permission';
    protected const DESCRIPTION = 'Retrieve Service Tokens Permission

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/service-tokens/{service_token_id}/permissions/

List permissions of a given ServiceToken for an account.';
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
  'service_token_id' =>
  array (
    'type' => 'integer',
    'description' => 'service_token_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/service-tokens/{service_token_id}/permissions/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'service_token_id' => 'service_token_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
