<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Indexing Datasources Items List.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/indexing/{+name}/items.
 */
class GoogleCloudSearchIndexingDatasourcesItemsList extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_indexing_datasources_items_list';
    protected const DESCRIPTION = 'Indexing Datasources Items List

Official Google Cloud Search endpoint: GET /v1/indexing/{+name}/items
Lists all or a subset of Item resources.';
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
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: connectorName, pageToken, debugOptions.enableDebugging, brief, pageSize.',
  ),
  'connectorName' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `connectorName`.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageToken`.',
  ),
  'debugOptions.enableDebugging' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `debugOptions.enableDebugging`.',
  ),
  'brief' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Shortcut for query parameter `brief`.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/indexing/{+name}/items';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'connectorName',
  1 => 'pageToken',
  2 => 'debugOptions.enableDebugging',
  3 => 'brief',
  4 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
}
