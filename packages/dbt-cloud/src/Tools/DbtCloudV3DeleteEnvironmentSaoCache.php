<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Delete Environment SAO Cache.
 *
 * Maps to the official dbt Cloud v3 endpoint delete /api/v3/accounts/{account_id}/environments/{environment_id}/sao-cache/.
 */
class DbtCloudV3DeleteEnvironmentSaoCache extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_delete_environment_sao_cache';
    protected const DESCRIPTION = 'Delete Environment SAO Cache

Official dbt Cloud v3 endpoint: DELETE /api/v3/accounts/{account_id}/environments/{environment_id}/sao-cache/

Clear the environment SAO (State Aware Orchestration) cache in Redis for the given environment';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'environment_id' =>
  array (
    'type' => 'integer',
    'description' => 'environment_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/v3/accounts/{account_id}/environments/{environment_id}/sao-cache/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'environment_id' => 'environment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
