<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a list of all accessible Tenants.
 *
 * Maps to the official Snyk endpoint get /tenants.
 */
class SnykListTenants extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_tenants';
    protected const DESCRIPTION = 'Get a list of all accessible Tenants

Official Snyk endpoint: GET /tenants

Get a list of all Tenants which the calling user is a member of';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Snyk API operation. Only return tenants whose name contains this value.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tenants';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'name' => 'name',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
