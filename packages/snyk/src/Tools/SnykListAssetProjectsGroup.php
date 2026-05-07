<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List projects for an asset (group scope) (Early Access).
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/inventory/assets/{asset_id}/relationships/projects.
 */
class SnykListAssetProjectsGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_asset_projects_group';
    protected const DESCRIPTION = 'List projects for an asset (group scope) (Early Access)

Official Snyk endpoint: GET /groups/{group_id}/inventory/assets/{asset_id}/relationships/projects

Retrieves a paginated list of Snyk projects linked to this asset with full attributes. Returns the `id`, `type`, and `attributes` of each related project. Scoped to the specified group. #### Required permissions - `View Groups (group.read)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The unique identifier of the group',
  ),
  'asset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `asset_id` from the official Snyk API operation. The unique identifier of the asset',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested API version',
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
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Maximum number of results to return per page',
  ),
  'canonical' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `canonical` from the official Snyk API operation. Filter projects by canonical status. - `with`: Returns all projects (canonical attribute is populated). - `only`: Returns only canonical ...',
    'enum' =>
    array (
      0 => 'with',
      1 => 'only',
      2 => 'none',
    ),
  ),
  'target_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `target_id` from the official Snyk API operation. Filter projects by target ID. When provided, returns only projects that belong to the specified target. When omitted, returns projects fr...',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort` from the official Snyk API operation. Sort field with optional direction prefix. Prefix with `-` for descending order. **Supported fields:** - `snapshot_created_at` - Snapshot...',
    'enum' =>
    array (
      0 => 'snapshot_created_at',
      1 => '-snapshot_created_at',
      2 => 'issues',
      3 => '-issues',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/inventory/assets/{asset_id}/relationships/projects';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'asset_id' => 'asset_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'canonical' => 'canonical',
  'target_id' => 'target_id',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
