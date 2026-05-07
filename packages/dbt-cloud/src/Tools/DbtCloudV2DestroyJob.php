<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Destroy Job.
 *
 * Maps to the official dbt Cloud v2 endpoint delete /api/v2/accounts/{account_id}/jobs/{id}/.
 */
class DbtCloudV2DestroyJob extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_destroy_job';
    protected const DESCRIPTION = 'Destroy Job

Official dbt Cloud v2 endpoint: DELETE /api/v2/accounts/{account_id}/jobs/{id}/

Delete a job';
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
    protected const PATH = '/api/v2/accounts/{account_id}/jobs/{id}/';
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
