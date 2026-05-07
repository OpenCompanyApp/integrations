<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get targets by org ID.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/targets.
 */
class SnykGetOrgsTargets extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_orgs_targets';
    protected const DESCRIPTION = 'Get targets by org ID

Official Snyk endpoint: GET /orgs/{org_id}/targets

Get a list of an organization\'s targets. #### Required permissions - `View Projects (org.project.read)`';
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
  'count' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `count` from the official Snyk API operation. Calculate total amount of filtered results',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The id of the org to return a list of targets',
  ),
  'is_private' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_private` from the official Snyk API operation. Return targets that match the provided value of is_private',
  ),
  'exclude_empty' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `exclude_empty` from the official Snyk API operation. Return only the targets that has projects',
  ),
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `url` from the official Snyk API operation. Return targets that match the provided remote_url.',
  ),
  'source_types' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `source_types` from the official Snyk API operation. Return targets that match the provided source_types',
  ),
  'display_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `display_name` from the official Snyk API operation. Return targets with display names starting with the provided string',
  ),
  'created_gte' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `created_gte` from the official Snyk API operation. Return only targets which have been created at or after the specified date.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/targets';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'count' => 'count',
  'limit' => 'limit',
  'is_private' => 'is_private',
  'exclude_empty' => 'exclude_empty',
  'url' => 'url',
  'source_types' => 'source_types',
  'display_name' => 'display_name',
  'created_gte' => 'created_gte',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
