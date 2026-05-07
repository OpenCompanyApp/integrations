<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Debug Datasources Items Search By View Url.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/debug/{+name}/items:searchByViewUrl.
 */
class GoogleCloudSearchDebugDatasourcesItemsSearchByViewUrl extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_debug_datasources_items_search_by_view_url';
    protected const DESCRIPTION = 'Debug Datasources Items Search By View Url

Official Google Cloud Search endpoint: POST /v1/debug/{+name}/items:searchByViewUrl
Fetches the item whose viewUrl exactly matches that of the URL provided in the request.';
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
    'description' => 'JSON request body matching the official Google Cloud Search `SearchItemsByViewUrlRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/debug/{+name}/items:searchByViewUrl';
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
