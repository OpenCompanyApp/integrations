<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Settings Searchapplications Patch.
 *
 * Maps to the official Google Cloud Search endpoint PATCH /v1/settings/{+name}.
 */
class GoogleCloudSearchSettingsSearchapplicationsPatch extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_settings_searchapplications_patch';
    protected const DESCRIPTION = 'Settings Searchapplications Patch

Official Google Cloud Search endpoint: PATCH /v1/settings/{+name}
Updates a search application.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Google Cloud Search resource names such as `datasources/source`, `datasources/source/items/item`, `searchapplications/app`, or long-running operation names.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: updateMask.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `updateMask`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `SearchApplication` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/settings/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
}
