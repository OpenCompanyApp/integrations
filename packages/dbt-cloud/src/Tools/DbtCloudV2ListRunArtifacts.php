<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Run Artifacts.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/runs/{run_id}/artifacts/.
 */
class DbtCloudV2ListRunArtifacts extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_list_run_artifacts';
    protected const DESCRIPTION = 'List Run Artifacts

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/runs/{run_id}/artifacts/

Retrieve the list of artifacts generated for a run.';
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
  'run_id' =>
  array (
    'type' => 'integer',
    'description' => 'run_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/runs/{run_id}/artifacts/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'run_id' => 'run_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
