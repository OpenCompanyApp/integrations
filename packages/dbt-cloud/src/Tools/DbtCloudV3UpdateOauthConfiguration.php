<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Update OAuth Configuration.
 *
 * Maps to the official dbt Cloud v3 endpoint post /api/v3/accounts/{account_id}/oauth-configurations/{id}/.
 */
class DbtCloudV3UpdateOauthConfiguration extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_update_oauth_configuration';
    protected const DESCRIPTION = 'Update OAuth Configuration

Official dbt Cloud v3 endpoint: POST /api/v3/accounts/{account_id}/oauth-configurations/{id}/

Update an OAuthConfiguration';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the dbt Cloud API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v3/accounts/{account_id}/oauth-configurations/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
