<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List accessible organizations.
 *
 * Maps to the official Snyk endpoint get /orgs.
 */
class SnykListOrgs extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_orgs';
    protected const DESCRIPTION = 'List accessible organizations

Official Snyk endpoint: GET /orgs

Get a paginated list of organizations you have access to.';
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
    'required' => false,
    'description' => 'Query parameter `group_id` from the official Snyk API operation. If set, only return organizations within the specified group',
  ),
  'is_personal' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_personal` from the official Snyk API operation. If true, only return organizations that are not part of a group.',
  ),
  'slug' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `slug` from the official Snyk API operation. Only return orgs whose slug exactly matches this value.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Snyk API operation. Only return orgs whose name contains this value.',
  ),
  'expand' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `expand` from the official Snyk API operation. Expand the specified related resources in the response to include their attributes.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'group_id' => 'group_id',
  'is_personal' => 'is_personal',
  'slug' => 'slug',
  'name' => 'name',
  'expand' => 'expand',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
