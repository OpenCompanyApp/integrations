<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Indexing Datasources Items Get.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/indexing/{+name}.
 */
class GoogleCloudSearchIndexingDatasourcesItemsGet extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_indexing_datasources_items_get';
    protected const DESCRIPTION = 'Indexing Datasources Items Get

Official Google Cloud Search endpoint: GET /v1/indexing/{+name}
Gets Item resource by item name.';
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
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: connectorName, debugOptions.enableDebugging.',
  ),
  'connectorName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `connectorName`.',
  ),
  'debugOptions.enableDebugging' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `debugOptions.enableDebugging`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/indexing/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'connectorName',
  1 => 'debugOptions.enableDebugging',
);
    protected const BODY_REQUIRED = false;
}
