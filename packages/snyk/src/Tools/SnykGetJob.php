<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a test job. (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/test_jobs/{job_id}.
 */
class SnykGetJob extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_job';
    protected const DESCRIPTION = 'Get a test job. (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/test_jobs/{job_id}

Get a test job. The Test API is Asynchronous, and Tests begun through the API are assigned a Job ID which references the in-progress Test. The Job ID is provided in a successful response from the CreateTest endpoint. This endpoint is used to poll for the status of a Test using its associated Job ID. When the Job is Finished and the Test is ready for consumption, the Related link will be populated in the response with a link to the finished Test entity. #### Required permissions - `View Organization (org.read)`';
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
  'job_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `job_id` from the official Snyk API operation. Job ID returned from the Test API to query.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/test_jobs/{job_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'job_id' => 'job_id',
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
