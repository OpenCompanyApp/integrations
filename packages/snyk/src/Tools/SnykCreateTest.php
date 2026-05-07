<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a new test. (Early Access).
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/tests.
 */
class SnykCreateTest extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_test';
    protected const DESCRIPTION = 'Create a new test. (Early Access)

Official Snyk endpoint: POST /orgs/{org_id}/tests

Create a new test. Provide the items to be tested by Snyk as well as any configuration parameters for the test to be run. Currently, scans using the Open Source (SCA) and Code Analysis (SAST) scanners can be run using the Test API. Tests begun through the Test API yield lists of Findings when finished. These Findings can be retrieved using the ListFindings endpoint. Successfully creating a new Test will yield a Job ID that can be used to poll for the Test\'s completion via the GetJob endpoint. #### Required permissions - `View Organization (org.read)` - `Test packages (org.package.test)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/tests';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
  'snyk-request-id' => 'snyk_request_id',
  'snyk-interaction-id' => 'snyk_interaction_id',
);
    protected const BODY_REQUIRED = true;
}
