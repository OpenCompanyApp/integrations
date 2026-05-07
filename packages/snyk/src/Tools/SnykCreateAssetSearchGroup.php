<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create an asset search (asynchronous) - Group scope (Early Access).
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/inventory/assets/searches.
 */
class SnykCreateAssetSearchGroup extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_asset_search_group';
    protected const DESCRIPTION = 'Create an asset search (asynchronous) - Group scope (Early Access)

Official Snyk endpoint: POST /groups/{group_id}/inventory/assets/searches

Initiates an asynchronous search for assets within a group context. #### Required permissions - `View Groups (group.read)`';
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
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/groups/{group_id}/inventory/assets/searches';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
