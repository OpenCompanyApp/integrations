<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Indexing Datasources Update Schema.
 *
 * Maps to the official Google Cloud Search endpoint PUT /v1/indexing/{+name}/schema.
 */
class GoogleCloudSearchIndexingDatasourcesUpdateSchema extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_indexing_datasources_update_schema';
    protected const DESCRIPTION = 'Indexing Datasources Update Schema

Official Google Cloud Search endpoint: PUT /v1/indexing/{+name}/schema
Updates the schema of a data source.';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name`. Use full Google Cloud Search resource names such as `datasources/source`, `datasources/source/items/item`, `searchapplications/app`, or long-running operation names.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Cloud Search `UpdateSchemaRequest` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/indexing/{+name}/schema';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
