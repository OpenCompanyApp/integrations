<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update asset attributes - Group scope (Early Access).
 *
 * Maps to the official Snyk endpoint patch /groups/{group_id}/inventory/assets/{asset_id}.
 */
class SnykUpdateAssetGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_asset_group';
    protected const DESCRIPTION = 'Update asset attributes - Group scope (Early Access)

Official Snyk endpoint: PATCH /groups/{group_id}/inventory/assets/{asset_id}

Partially updates an asset\'s attributes within a group context. Supports updating class, labels (add/remove), and tags (add/remove). #### Required permissions - `Edit Group Details (group.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/groups/{group_id}/inventory/assets/{asset_id}';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'asset_id' => 'asset_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
