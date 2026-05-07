<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List Assets with filters (Early Access).
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/assets/search.
 */
class SnykListAssets extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_assets';
    protected const DESCRIPTION = 'List Assets with filters (Early Access)

Official Snyk endpoint: POST /groups/{group_id}/assets/search

List Assets with filters #### Required permissions - `View Groups (group.read)`';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'post';
    protected const PATH = '/groups/{group_id}/assets/search';
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
