<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List personal access tokens.
 *
 * Maps to the official Snyk endpoint get /self/personal_access_tokens.
 */
class SnykListPersonalAccessToken extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_personal_access_token';
    protected const DESCRIPTION = 'List personal access tokens

Official Snyk endpoint: GET /self/personal_access_tokens

List personal access tokens';
    protected const PARAMETERS = array (
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
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/self/personal_access_tokens';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
