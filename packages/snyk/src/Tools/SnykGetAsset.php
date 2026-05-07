<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get an Asset by its ID (Early Access).
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/assets/{asset_id}.
 */
class SnykGetAsset extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_asset';
    protected const DESCRIPTION = 'Get an Asset by its ID (Early Access)

Official Snyk endpoint: GET /groups/{group_id}/assets/{asset_id}

Get an Asset by its ID #### Required permissions - `View Groups (group.read)`';
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
);
    protected const METHOD = 'get';
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
    protected const BODY_REQUIRED = false;
}
