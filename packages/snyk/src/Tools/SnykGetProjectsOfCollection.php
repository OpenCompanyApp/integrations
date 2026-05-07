<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get projects from the specified collection.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/collections/{collection_id}/relationships/projects.
 */
class SnykGetProjectsOfCollection extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_projects_of_collection';
    protected const DESCRIPTION = 'Get projects from the specified collection

Official Snyk endpoint: GET /orgs/{org_id}/collections/{collection_id}/relationships/projects

Return a list of organization\'s projects that are from the specified collection. #### Required permissions - `View Collections (org.collection.read)` - `View Projects (org.project.read)` - `View Project history (org.project.snapshot.read)`';
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
  'collection_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `collection_id` from the official Snyk API operation. Unique identifier for a collection',
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
    'description' => 'Query parameter `sort` from the official Snyk API operation. Return projects sorted by the specified attributes',
    'enum' =>
    array (
      0 => 'imported',
      1 => 'last_tested_at',
      2 => 'issues',
    ),
  ),
  'direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `direction` from the official Snyk API operation. Return projects sorted in the specified direction',
    'enum' =>
    array (
      0 => 'ASC',
      1 => 'DESC',
    ),
  ),
  'target_id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `target_id` from the official Snyk API operation. Return projects that belong to the provided targets',
  ),
  'show' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `show` from the official Snyk API operation. Return projects that are with or without issues',
  ),
  'integration' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `integration` from the official Snyk API operation. Return projects that match the provided integration types',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/collections/{collection_id}/relationships/projects';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'collection_id' => 'collection_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'sort' => 'sort',
  'direction' => 'direction',
  'target_id' => 'target_id',
  'show' => 'show',
  'integration' => 'integration',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
