<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get available group fields - Group scope (Early Access).
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/inventory/assets/groups.
 */
class SnykGetGroupFieldsGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_group_fields_group';
    protected const DESCRIPTION = 'Get available group fields - Group scope (Early Access)

Official Snyk endpoint: GET /groups/{group_id}/inventory/assets/groups

Returns a list of valid group field names that can be used for grouping assets within a group context. #### Required permissions - `View Groups (group.read)`';
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
  'asset_types' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `asset_types` from the official Snyk API operation. Comma-separated list of asset types to filter group fields',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/inventory/assets/groups';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'asset_types' => 'asset_types',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
