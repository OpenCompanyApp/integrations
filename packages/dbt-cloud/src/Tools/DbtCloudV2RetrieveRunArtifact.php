<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Run Artifact.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/runs/{run_id}/artifacts/{remainder}.
 */
class DbtCloudV2RetrieveRunArtifact extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_retrieve_run_artifact';
    protected const DESCRIPTION = 'Retrieve Run Artifact

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/runs/{run_id}/artifacts/{remainder}

Use this endpoint to fetch artifacts from a completed run. Once a run has been completed, you can use this endpoint to download the `manifest.json`, `run_results.json`, or `catalog.json` files from dbt Cloud. These artifacts contain information about the models in your dbt project, timing information around their execution, and a status message indicating the result of the model build. By default, this endpoint returns artifacts from the last step in the run. To list artifacts from other steps in the run, use the step query parameter described below.';
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
  'remainder' =>
  array (
    'type' => 'string',
    'description' => 'remainder parameter.',
    'required' => true,
  ),
  'run_id' =>
  array (
    'type' => 'integer',
    'description' => 'run_id parameter.',
    'required' => true,
  ),
  'step' =>
  array (
    'type' => 'integer',
    'description' => 'The index of the Step in the Run to query for artifacts. The first step in the run has the index `1`. If the `step` parameter is omitted, then this endpoint will return the artifacts compiled for the last step in the run.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/runs/{run_id}/artifacts/{remainder}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'remainder' => 'remainder',
  'run_id' => 'run_id',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
  'step' => 'step',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
