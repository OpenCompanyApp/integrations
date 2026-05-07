<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Indexing Datasources Items Push.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/indexing/{+name}:push.
 */
class GoogleCloudSearchIndexingDatasourcesItemsPush extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_indexing_datasources_items_push';
    protected const DESCRIPTION = 'Indexing Datasources Items Push

Official Google Cloud Search endpoint: POST /v1/indexing/{+name}:push
Pushes an item onto a queue for later polling and updating.';
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
    'description' => 'JSON request body matching the official Google Cloud Search `PushItemRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/indexing/{+name}:push';
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
