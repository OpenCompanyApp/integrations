<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Stats Query Searchapplications Get.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/stats/query/{+name}.
 */
class GoogleCloudSearchStatsQuerySearchapplicationsGet extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_stats_query_searchapplications_get';
    protected const DESCRIPTION = 'Stats Query Searchapplications Get

Official Google Cloud Search endpoint: GET /v1/stats/query/{+name}
Get the query statistics for search application.';
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
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: fromDate.year, fromDate.month, toDate.day, fromDate.day, toDate.year, toDate.month.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/stats/query/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'fromDate.year',
  1 => 'fromDate.month',
  2 => 'toDate.day',
  3 => 'fromDate.day',
  4 => 'toDate.year',
  5 => 'toDate.month',
);
    protected const BODY_REQUIRED = false;
}
