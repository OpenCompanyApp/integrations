<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Cancel Run.
 *
 * Maps to the official dbt Cloud v2 endpoint post /api/v2/accounts/{account_id}/runs/{run_id}/cancel/.
 */
class DbtCloudV2CancelRun extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_cancel_run';
    protected const DESCRIPTION = 'Cancel Run

Official dbt Cloud v2 endpoint: POST /api/v2/accounts/{account_id}/runs/{run_id}/cancel/

Cancel a run.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'run_id' =>
  array (
    'type' => 'integer',
    'description' => 'run_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v2/accounts/{account_id}/runs/{run_id}/cancel/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'run_id' => 'run_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
