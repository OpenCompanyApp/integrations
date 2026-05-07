<?php

namespace OpenCompany\Integrations\DbtCloud\Tools;

/**
 * List Favorite Asset Responses.
 *
 * Maps to the official dbt Cloud v3 endpoint get /api/v3/accounts/{account_id}/favorite-assets/.
 */
class DbtCloudV3ListFavoriteAssetResponses extends AbstractDbtCloudTool
{
    protected const NAME = 'dbt_cloud_v3_list_favorite_asset_responses';
    protected const DESCRIPTION = 'List Favorite Asset Responses

Official dbt Cloud v3 endpoint: GET /api/v3/accounts/{account_id}/favorite-assets/

List all Favorite Asset Responses.';
    protected const PARAMETERS = array (
  'account_id' =>
  array (
    'type' => 'integer',
    'description' => 'account_id parameter.',
    'required' => true,
  ),
  'environment_id' =>
  array (
    'type' => 'integer',
    'description' => 'The environment ID the favorited asset is associated with. Can be null for data warehouse assets.',
  ),
  'include_related' =>
  array (
    'type' => 'string',
    'description' => 'Comma-separated list of related objects to include in the response.',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'description' => 'The maximum number of items to return.',
  ),
  'offset' =>
  array (
    'type' => 'integer',
    'description' => 'The number of items to skip before starting to collect the result set.',
  ),
  'project_id' =>
  array (
    'type' => 'integer',
    'description' => 'The project ID the favorited asset is associated with',
  ),
  'user_id' =>
  array (
    'type' => 'integer',
    'description' => 'The user ID the favorited asset is associated with',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v3/accounts/{account_id}/favorite-assets/';
    protected const PATH_PARAMS = array (
  'account_id' => 'account_id',
);
    protected const QUERY_PARAMS = array (
  'environment_id' => 'environment_id',
  'include_related' => 'include_related',
  'limit' => 'limit',
  'offset' => 'offset',
  'project_id' => 'project_id',
  'user_id' => 'user_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
