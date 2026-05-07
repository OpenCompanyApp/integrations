<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get access requests (Early Access).
 *
 * Maps to the official Snyk endpoint get /self/access_requests.
 */
class SnykGetAccessRequests extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_access_requests';
    protected const DESCRIPTION = 'Get access requests (Early Access)

Official Snyk endpoint: GET /self/access_requests

Get a list of user\'s access requests';
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
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `org_id` from the official Snyk API operation. The IDs of the org to filter by',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/self/access_requests';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'org_id' => 'org_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
