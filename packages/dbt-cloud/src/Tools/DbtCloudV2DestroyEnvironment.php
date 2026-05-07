<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy Environment.
 *
 * Maps to the official dbt Cloud v2 endpoint delete /api/v2/accounts/{account_id}/environments/{id}/.
 */
class DbtCloudV2DestroyEnvironment extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_destroy_environment';
    protected const DESCRIPTION = 'Destroy Environment

Official dbt Cloud v2 endpoint: DELETE /api/v2/accounts/{account_id}/environments/{id}/

Deprecated. Consider using the v3 API instead.';
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
    protected const PATH = '/api/v2/accounts/{account_id}/environments/{id}/';
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
