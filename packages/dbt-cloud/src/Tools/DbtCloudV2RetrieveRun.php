<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Run.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/runs/{id}/.
 */
class DbtCloudV2RetrieveRun extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_retrieve_run';
    protected const DESCRIPTION = 'Retrieve Run

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/runs/{id}/

Retrieve details of a run.';
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
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'A list of related objects to include in the response. Valid values are `trigger`, `job`, `environment`, `repository`, `run_steps`, `run_retries`, `used_repo_cache`, `repo_cache_restore`, `audit`, and `debug_logs`. If `debug_logs` is not provided, then the included debug logs will be truncated to the last 1,000 lines of the debug log output file.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/runs/{id}/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
