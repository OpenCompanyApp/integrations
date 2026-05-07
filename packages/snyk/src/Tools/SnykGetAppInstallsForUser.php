<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a list of Snyk Apps installed for a user.
 *
 * Maps to the official Snyk endpoint get /self/apps/installs.
 */
class SnykGetAppInstallsForUser extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_app_installs_for_user';
    protected const DESCRIPTION = 'Get a list of Snyk Apps installed for a user

Official Snyk endpoint: GET /self/apps/installs

Get a list of Snyk Apps installed for a user';
    protected const PARAMETERS = array (
  'expand' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `expand` from the official Snyk API operation. Expand relationships.',
  ),
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
);
    protected const METHOD = 'get';
    protected const PATH = '/self/apps/installs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'expand' => 'expand',
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
