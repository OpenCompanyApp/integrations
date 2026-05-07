<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get an AI-BOM job status (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/ai_bom_jobs/{job_id}.
 */
class SnykGetAiBomJob extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_ai_bom_job';
    protected const DESCRIPTION = 'Get an AI-BOM job status (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/ai_bom_jobs/{job_id}

Returns the status of an AI-BOM job. The job status is returned in the response body. If the job is completed the response status code will be 303, redirecting to the getAiBom endpoint. #### Required permissions - `View Organization (org.read)`';
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
  'job_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `job_id` from the official Snyk API operation. The job id',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/ai_bom_jobs/{job_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'job_id' => 'job_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
