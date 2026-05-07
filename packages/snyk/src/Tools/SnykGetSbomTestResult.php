<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Gets an SBOM test run result (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/sbom_tests/{job_id}/results.
 */
class SnykGetSbomTestResult extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_sbom_test_result';
    protected const DESCRIPTION = 'Gets an SBOM test run result (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/sbom_tests/{job_id}/results

Get an SBOM test run result #### Required permissions - `Test Projects (org.project.test)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
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
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Snyk API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/sbom_tests/{job_id}/results';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'job_id' => 'job_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}
