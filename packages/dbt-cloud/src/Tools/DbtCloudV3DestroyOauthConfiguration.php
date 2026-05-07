<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy OAuth Configuration.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/oauth-configurations/{id}/.
 */
class DbtCloudV3DestroyOauthConfiguration extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_destroy_oauth_configuration';
    protected const DESCRIPTION = 'Destroy OAuth Configuration

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/oauth-configurations/{id}/

Delete an OAuth Configuration';
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
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v3/accounts/{account_id}/oauth-configurations/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
