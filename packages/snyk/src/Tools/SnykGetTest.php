<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a test. (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/tests/{test_id}.
 */
class SnykGetTest extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_test';
    protected const DESCRIPTION = 'Get a test. (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/tests/{test_id}

Get a test. A Test returned through this endpoint is intended to be a completed Test with results. The data returned through this endpoint does not contain the Findings for the Test, but a description of the Test that was run and its status. Tests that completed successfully are marked with an appropriate outcome according to the configured Thresholds. Facts about the Test (e.g. how many dependencies were present in a Tested SBOM) are attached to this response as well as a summary of the Findings uncovered during the Test. Any Errors or Warnings that occurred during the Test will be present in the response from this endpoint. The response will also contain a link to the first page of the Test\'s Findings. #### Required permissions - `View Organization (org.read)`';
    protected const PARAMETERS = array (
  'snyk_request_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `snyk-request-id` from the official Snyk API operation. A unique ID assigned to each API request, for tracing and troubleshooting. Snyk clients can optionally provide this ID.',
  ),
  'snyk_interaction_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `snyk-interaction-id` from the official Snyk API operation. Identifies the Snyk client interaction in which this API request occurs. The identifier is an opaque string. though at the time of writin...',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The API version requested.',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Snyk Org ID under which to run or query information about a Job or Test.',
  ),
  'test_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `test_id` from the official Snyk API operation. Test ID returned from the Test API to query.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/tests/{test_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'test_id' => 'test_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
  'snyk-request-id' => 'snyk_request_id',
  'snyk-interaction-id' => 'snyk_interaction_id',
);
    protected const BODY_REQUIRED = false;
}
