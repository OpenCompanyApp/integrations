<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a dry run job.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/container_import/{integration_id}/policy/dry_run/{job_id}.
 */
class SnykGetDryRunJob extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_dry_run_job';
    protected const DESCRIPTION = 'Get a dry run job

Official Snyk endpoint: GET /orgs/{org_id}/container_import/{integration_id}/policy/dry_run/{job_id}

Retrieves the status and results of a dry run job #### Required permissions - `Edit integrations (org.integration.edit)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'integration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `integration_id` from the official Snyk API operation. Container Registry Integration ID',
  ),
  'job_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `job_id` from the official Snyk API operation. Dry run job ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/container_import/{integration_id}/policy/dry_run/{job_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'integration_id' => 'integration_id',
  'job_id' => 'job_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
