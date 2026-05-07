<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Indexing Datasources Items Delete.
 *
 * Maps to the official Google Cloud Search endpoint DELETE /v1/indexing/{+name}.
 */
class GoogleCloudSearchIndexingDatasourcesItemsDelete extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_indexing_datasources_items_delete';
    protected const DESCRIPTION = 'Indexing Datasources Items Delete

Official Google Cloud Search endpoint: DELETE /v1/indexing/{+name}
Deletes Item resource for the specified resource name.';
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
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: mode, version, connectorName, debugOptions.enableDebugging.',
  ),
  'mode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `mode`.',
    'enum' =>
    array (
      0 => 'UNSPECIFIED',
      1 => 'SYNCHRONOUS',
      2 => 'ASYNCHRONOUS',
    ),
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `version`.',
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
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/indexing/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'mode',
  1 => 'version',
  2 => 'connectorName',
  3 => 'debugOptions.enableDebugging',
);
    protected const BODY_REQUIRED = false;
}
