<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Indexing Datasources Items Index.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/indexing/{+name}:index.
 */
class GoogleCloudSearchIndexingDatasourcesItemsIndex extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_indexing_datasources_items_index';
    protected const DESCRIPTION = 'Indexing Datasources Items Index

Official Google Cloud Search endpoint: POST /v1/indexing/{+name}:index
Updates Item ACL, metadata, and content.';
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
    'description' => 'JSON request body matching the official Google Cloud Search `IndexItemRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/indexing/{+name}:index';
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
