<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy Service Token.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/service-tokens/{id}/.
 */
class DbtCloudV3DestroyServiceToken extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_destroy_service_token';
    protected const DESCRIPTION = 'Destroy Service Token

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/service-tokens/{id}/';
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
    protected const PATH = '/api/v3/accounts/{account_id}/service-tokens/{id}/';
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
