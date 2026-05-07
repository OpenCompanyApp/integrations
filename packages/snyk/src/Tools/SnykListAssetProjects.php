<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List asset projects with pagination (Early Access).
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/assets/{asset_id}/relationships/projects.
 */
class SnykListAssetProjects extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_asset_projects';
    protected const DESCRIPTION = 'List asset projects with pagination (Early Access)

Official Snyk endpoint: GET /groups/{group_id}/assets/{asset_id}/relationships/projects

List asset projects with pagination #### Required permissions - `View Groups (group.read)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
  'asset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `asset_id` from the official Snyk API operation. Unique identifier for the Asset',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return records after the record identified by cursor position starting_after',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return records before the record identified by cursor position ending_before',
  ),
  'limit' =>
  array (
    'type' => 'number',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of records to return',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/assets/{asset_id}/relationships/projects';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'asset_id' => 'asset_id',
);
    protected const QUERY_PARAMS = array (
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
