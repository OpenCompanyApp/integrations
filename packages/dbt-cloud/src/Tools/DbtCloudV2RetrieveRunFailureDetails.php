<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Run Failure Details.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/runs/{run_id}/retry/.
 */
class DbtCloudV2RetrieveRunFailureDetails extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_retrieve_run_failure_details';
    protected const DESCRIPTION = 'Retrieve Run Failure Details

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/runs/{run_id}/retry/

Use this endpoint to get details about a retryable run that has failed.';
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
    protected const PATH = '/api/v2/accounts/{account_id}/runs/{run_id}/retry/';
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
