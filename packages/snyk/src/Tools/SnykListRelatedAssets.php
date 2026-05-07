<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List related assets with pagination (Early Access).
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/assets/{asset_id}/relationships/assets.
 */
class SnykListRelatedAssets extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_related_assets';
    protected const DESCRIPTION = 'List related assets with pagination (Early Access)

Official Snyk endpoint: GET /groups/{group_id}/assets/{asset_id}/relationships/assets

List related assets with pagination #### Required permissions - `View Groups (group.read)`';
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
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `type` from the official Snyk API operation. Filter by asset type',
    'enum' =>
    array (
      0 => 'repository',
      1 => 'package',
      2 => 'image',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/groups/{group_id}/assets/{asset_id}/relationships/assets';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'asset_id' => 'asset_id',
);
    protected const QUERY_PARAMS = array (
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'version' => 'version',
  'type' => 'type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
