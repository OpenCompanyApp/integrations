<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update asset attributes (Early Access).
 *
 * Maps to the official Snyk endpoint patch /groups/{group_id}/assets/{asset_id}.
 */
class SnykUpdateAsset extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_asset';
    protected const DESCRIPTION = 'Update asset attributes (Early Access)

Official Snyk endpoint: PATCH /groups/{group_id}/assets/{asset_id}

The endpoint allows for partial updates to an asset\'s attributes. #### Required permissions - `Edit Group Details (group.edit)`';
    protected const PARAMETERS = array (
  'asset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `asset_id` from the official Snyk API operation. Unique identifier for the Asset',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/groups/{group_id}/assets/{asset_id}';
    protected const PATH_PARAMS = array (
  'asset_id' => 'asset_id',
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
