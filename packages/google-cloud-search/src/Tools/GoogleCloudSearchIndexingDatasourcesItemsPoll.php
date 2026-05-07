<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Indexing Datasources Items Poll.
 *
 * Maps to the official Google Cloud Search endpoint POST /v1/indexing/{+name}/items:poll.
 */
class GoogleCloudSearchIndexingDatasourcesItemsPoll extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_indexing_datasources_items_poll';
    protected const DESCRIPTION = 'Indexing Datasources Items Poll

Official Google Cloud Search endpoint: POST /v1/indexing/{+name}/items:poll
Polls for unreserved items from the indexing queue and marks a set as reserved, starting with items that have the oldest timestamp from the highest priority ItemStatus.';
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
    'description' => 'JSON request body matching the official Google Cloud Search `PollItemsRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/indexing/{+name}/items:poll';
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
