<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Debug Datasources Items Unmappedids List.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/debug/{+parent}/unmappedids.
 */
class GoogleCloudSearchDebugDatasourcesItemsUnmappedidsList extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_debug_datasources_items_unmappedids_list';
    protected const DESCRIPTION = 'Debug Datasources Items Unmappedids List

Official Google Cloud Search endpoint: GET /v1/debug/{+parent}/unmappedids
List all unmapped identities for a specific item.';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent`. Use full Google Cloud Search resource names such as `datasources/source`, `datasources/source/items/item`, `searchapplications/app`, or long-running operation names.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: pageSize, pageToken, debugOptions.enableDebugging.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `pageSize`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/debug/{+parent}/unmappedids';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageSize',
  1 => 'pageToken',
  2 => 'debugOptions.enableDebugging',
);
    protected const BODY_REQUIRED = false;
}
