<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * Retrieve Job Artifact.
 *
 * Maps to the official dbt Cloud v2 endpoint get /api/v2/accounts/{account_id}/jobs/{job_id}/artifacts/{remainder}.
 */
class DbtCloudV2RetrieveJobArtifact extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v2_retrieve_job_artifact';
    protected const DESCRIPTION = 'Retrieve Job Artifact

Official dbt Cloud v2 endpoint: GET /api/v2/accounts/{account_id}/jobs/{job_id}/artifacts/{remainder}

Given a job id and *a set of Run filters* return the latest matching artifact for that job.';
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
  'job_id' =>
  array (
    'type' => 'integer',
    'description' => 'job_id parameter.',
    'required' => true,
  ),
  'remainder' =>
  array (
    'type' => 'string',
    'description' => 'remainder parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v2/accounts/{account_id}/jobs/{job_id}/artifacts/{remainder}';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
  'job_id' => 'job_id',
  'remainder' => 'remainder',
);
    protected const QUERY_PARAMS = array (
  'include_related' => 'include_related',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
