<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Retrieve asset search results (asynchronous) - Group scope (Early Access).
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/inventory/assets/searches/{search_id}/results.
 */
class SnykGetAssetSearchResultsGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_asset_search_results_group';
    protected const DESCRIPTION = 'Retrieve asset search results (asynchronous) - Group scope (Early Access)

Official Snyk endpoint: GET /groups/{group_id}/inventory/assets/searches/{search_id}/results

Gets paginated results for a previously initiated asset search within a group context. #### Required permissions - `View Groups (group.read)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The unique identifier of the group',
  ),
  'search_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `search_id` from the official Snyk API operation. The unique identifier of the search operation',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested API version',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort` from the official Snyk API operation. Sort order for results (e.g., -created_at for descending)',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Maximum number of results to return',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Cursor for forward pagination',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Cursor for backward pagination',
  ),
  'fields' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `fields` from the official Snyk API operation. Sparse fieldsets allow clients to request only specific fields for a given resource type. Use the format `fields[]=field1,field2` where `...',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/inventory/assets/searches/{search_id}/results';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'search_id' => 'search_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'sort' => 'sort',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'fields' => 'fields',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
