<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Debug Datasources Items Check Access.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/debug/{+name}:checkAccess.
 */
class GoogleCloudSearchDebugDatasourcesItemsCheckAccess extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_debug_datasources_items_check_access';
    protected const DESCRIPTION = 'Debug Datasources Items Check Access

Official Google Cloud Search endpoint: POST /v1/debug/{+name}:checkAccess
Checks whether an item is accessible by specified principal.';
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
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: debugOptions.enableDebugging.',
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
    'description' => 'JSON request body matching the official Google Cloud Search `Principal` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/debug/{+name}:checkAccess';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'debugOptions.enableDebugging',
);
    protected const BODY_REQUIRED = true;
}
