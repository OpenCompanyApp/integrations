<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Settings Datasources Patch.
 *
 * Maps to the official Google Cloud Search endpoint PATCH /v1/settings/{+name}.
 */
class GoogleCloudSearchSettingsDatasourcesPatch extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_settings_datasources_patch';
    protected const DESCRIPTION = 'Settings Datasources Patch

Official Google Cloud Search endpoint: PATCH /v1/settings/{+name}
Updates a datasource.';
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
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: updateMask, debugOptions.enableDebugging.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `updateMask`.',
  ),
  'debugOptions.enableDebugging' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `debugOptions.enableDebugging`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `DataSource` schema.',
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
  1 => 'debugOptions.enableDebugging',
);
    protected const BODY_REQUIRED = true;
}
