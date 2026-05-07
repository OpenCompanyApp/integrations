<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List or search all assets (synchronous) - Group scope (Early Access).
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/inventory/assets.
 */
class SnykListAssetsGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_assets_group';
    protected const DESCRIPTION = 'List or search all assets (synchronous) - Group scope (Early Access)

Official Snyk endpoint: GET /groups/{group_id}/inventory/assets

Retrieves a polymorphic list of all asset types for a given group. The tenant is resolved from the group_id. #### Required permissions - `View Groups (group.read)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The unique identifier of the group',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested API version',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `filter` from the official Snyk API operation. RSQL filter expression for filtering results. See schema for full documentation.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort` from the official Snyk API operation. Comma-separated sort fields. Prefix with `-` for descending order.',
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
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Cursor for fetching the next page of results',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Cursor for fetching the previous page of results',
  ),
  'fields' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `fields` from the official Snyk API operation. Sparse fieldsets allow clients to request only specific fields for a given resource type. Use the format `fields[]=field1,field2` where `...',
  ),
  'meta_count' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `meta_count` from the official Snyk API operation. Provide summary count in the response meta object when requested. When `with` is provided, the count will be included in the response met...',
    'enum' =>
    array (
      0 => 'with',
      1 => 'only',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/inventory/assets';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'filter' => 'filter',
  'sort' => 'sort',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'fields' => 'fields',
  'meta_count' => 'meta_count',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
