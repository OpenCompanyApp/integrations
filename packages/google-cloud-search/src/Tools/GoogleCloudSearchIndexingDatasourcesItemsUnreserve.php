<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Indexing Datasources Items Unreserve.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/indexing/{+name}/items:unreserve.
 */
class GoogleCloudSearchIndexingDatasourcesItemsUnreserve extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_indexing_datasources_items_unreserve';
    protected const DESCRIPTION = 'Indexing Datasources Items Unreserve

Official Google Cloud Search endpoint: POST /v1/indexing/{+name}/items:unreserve
Unreserves all items from a queue, making them all eligible to be polled.';
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
    'description' => 'JSON request body matching the official Google Cloud Search `UnreserveItemsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/indexing/{+name}/items:unreserve';
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
