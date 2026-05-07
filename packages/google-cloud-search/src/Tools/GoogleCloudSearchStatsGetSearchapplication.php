<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Stats Get Searchapplication.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/stats/searchapplication.
 */
class GoogleCloudSearchStatsGetSearchapplication extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_stats_get_searchapplication';
    protected const DESCRIPTION = 'Stats Get Searchapplication

Official Google Cloud Search endpoint: GET /v1/stats/searchapplication
Get search application stats for customer.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Cloud Search method. Known keys: endDate.month, endDate.day, endDate.year, startDate.month, startDate.day, startDate.year.',
  ),
  'endDate.month' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `endDate.month`.',
  ),
  'endDate.day' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `endDate.day`.',
  ),
  'endDate.year' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `endDate.year`.',
  ),
  'startDate.month' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `startDate.month`.',
  ),
  'startDate.day' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `startDate.day`.',
  ),
  'startDate.year' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Shortcut for query parameter `startDate.year`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/stats/searchapplication';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'endDate.month',
  1 => 'endDate.day',
  2 => 'endDate.year',
  3 => 'startDate.month',
  4 => 'startDate.day',
  5 => 'startDate.year',
);
    protected const BODY_REQUIRED = false;
}
