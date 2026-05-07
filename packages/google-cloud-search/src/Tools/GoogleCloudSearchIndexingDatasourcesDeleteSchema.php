<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Indexing Datasources Delete Schema.
 *
 * Maps to the official Google Cloud Search endpoint DELETE /v1/indexing/{+name}/schema.
 */
class GoogleCloudSearchIndexingDatasourcesDeleteSchema extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_indexing_datasources_delete_schema';
    protected const DESCRIPTION = 'Indexing Datasources Delete Schema

Official Google Cloud Search endpoint: DELETE /v1/indexing/{+name}/schema
Deletes the schema of a data source.';
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
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/indexing/{+name}/schema';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'debugOptions.enableDebugging',
);
    protected const BODY_REQUIRED = false;
}
