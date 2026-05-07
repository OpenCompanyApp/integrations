<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Stats Index Datasources Get.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/stats/index/{+name}.
 */
class GoogleCloudSearchStatsIndexDatasourcesGet extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_stats_index_datasources_get';
    protected const DESCRIPTION = 'Stats Index Datasources Get

Official Google Cloud Search endpoint: GET /v1/stats/index/{+name}
Gets indexed item statistics for a single data source.';
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
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: fromDate.day, toDate.year, toDate.month, fromDate.year, fromDate.month, toDate.day.',
  ),
  'fromDate.day' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `fromDate.day`.',
  ),
  'toDate.year' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `toDate.year`.',
  ),
  'toDate.month' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `toDate.month`.',
  ),
  'fromDate.year' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `fromDate.year`.',
  ),
  'fromDate.month' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `fromDate.month`.',
  ),
  'toDate.day' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `toDate.day`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/stats/index/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'fromDate.day',
  1 => 'toDate.year',
  2 => 'toDate.month',
  3 => 'fromDate.year',
  4 => 'fromDate.month',
  5 => 'toDate.day',
);
    protected const BODY_REQUIRED = false;
}
