<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Gets an SBOM test run status (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/sbom_tests/{job_id}.
 */
class SnykGetSbomTestStatus extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_sbom_test_status';
    protected const DESCRIPTION = 'Gets an SBOM test run status (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/sbom_tests/{job_id}

Get an SBOM test run status #### Required permissions - `Test Projects (org.project.test)`';
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
    'description' => 'Path parameter `job_id` from the official Snyk API operation. Job ID',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/sbom_tests/{job_id}';
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
