<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Job.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/jobs/{id}/.
 */
class DbtCloudV2RetrieveJob extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_retrieve_job';
    protected const DESCRIPTION = 'Retrieve Job

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/jobs/{id}/

Retrieve the details of a job.';
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
    'description' => 'A list of related objects to include in the response. Valid values are `environment`, `custom_environment_variables`, `most_recent_run`, `most_recent_completed_run`, and `fusion_readiness`.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/jobs/{id}/';
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
