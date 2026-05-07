<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get collections.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/collections.
 */
class SnykGetCollections extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_collections';
    protected const DESCRIPTION = 'Get collections

Official Snyk endpoint: GET /orgs/{org_id}/collections

Return a list of organization\'s collections with issues counts and projects count. #### Required permissions - `View Collections (org.collection.read)` - `View Project history (org.project.snapshot.read)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
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
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort` from the official Snyk API operation. Return collections sorted by the specified attributes',
    'enum' =>
    array (
      0 => 'name',
      1 => 'projectsCount',
      2 => 'issues',
    ),
  ),
  'direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `direction` from the official Snyk API operation. Return collections sorted in the specified direction',
    'enum' =>
    array (
      0 => 'ASC',
      1 => 'DESC',
    ),
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `name` from the official Snyk API operation. Return collections which names include the provided string',
  ),
  'is_generated' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `is_generated` from the official Snyk API operation. Return collections where is_generated matches the provided boolean',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/collections';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'sort' => 'sort',
  'direction' => 'direction',
  'name' => 'name',
  'is_generated' => 'is_generated',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
