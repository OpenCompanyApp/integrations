<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Bulk update asset attributes - Group scope (Early Access).
 *
 * Maps to the official Snyk endpoint patch /groups/{group_id}/inventory/assets.
 */
class SnykUpdateAssetsBulkGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_assets_bulk_group';
    protected const DESCRIPTION = 'Bulk update asset attributes - Group scope (Early Access)

Official Snyk endpoint: PATCH /groups/{group_id}/inventory/assets

Partially updates multiple assets within a group context. Maximum of 100 assets can be updated per request. The operation is transactional - all updates succeed or all fail. #### Required permissions - `Edit Group Details (group.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/groups/{group_id}/inventory/assets';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
