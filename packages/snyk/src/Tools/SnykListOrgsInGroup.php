<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List all organizations in group.
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/orgs.
 */
class SnykListOrgsInGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_orgs_in_group';
    protected const DESCRIPTION = 'List all organizations in group

Official Snyk endpoint: GET /groups/{group_id}/orgs

Get a paginated list of all the organizations belonging to the group. By default, this endpoint returns the organizations in alphabetical order of their name. #### Required permissions - `View Groups (group.read)` - `View Organizations (group.org.list)`';
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
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Unique identifier for group',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Snyk API operation. Only return organizations whose name contains this value. Case insensitive.',
  ),
  'slug' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `slug` from the official Snyk API operation. Only return organizations whose slug exactly matches this value. Case sensitive.',
  ),
  'expand' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `expand` from the official Snyk API operation. Expand the response with additional fields. When set to `count`, the response will include a `meta` object containing a `total_count` fie...',
    'enum' =>
    array (
      0 => 'count',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/orgs';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'name' => 'name',
  'slug' => 'slug',
  'expand' => 'expand',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
