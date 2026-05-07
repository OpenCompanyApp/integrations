<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List findings for a test. (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/tests/{test_id}/findings.
 */
class SnykListFindings extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_findings';
    protected const DESCRIPTION = 'List findings for a test. (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/tests/{test_id}/findings

List findings for a test. Test Findings are scanner-agnostic representations of vulnerabilities and organization-level policy breaches. When Snyk runs a Test, the results of that Test are formatted into Findings. This endpoint returns pages of Findings associated with a given Test ID. Findings are returned in sorted order by ID, with page size equal to the provided Limit query parameter. Page size is 10 Findings by default if no parameter is provided. Note that the Findings returned from this endpoint are only the Findings that are _not_ suppressed by policy and are _not_ in violation of a set Test threshold (like Severity or Risk Score). To retrieve the next (or previous) page of Findings, utilize the Next and Prev links returned in the response. #### Required permissions - `View Organization (org.read)`';
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
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Opaque pagination cursor for forward traversal.',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Opaque pagination cursor for reverse traversal.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. The number of items to return.',
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
    protected const PATH = '/orgs/{org_id}/tests/{test_id}/findings';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'test_id' => 'test_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
  'snyk-request-id' => 'snyk_request_id',
  'snyk-interaction-id' => 'snyk_interaction_id',
);
    protected const BODY_REQUIRED = false;
}
