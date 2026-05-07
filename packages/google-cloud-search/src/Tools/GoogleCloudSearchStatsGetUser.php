<?php

namespace OpenCompany\Integrations\GoogleCloudSearch\Tools;

/**
 * Stats Get User.
 *
 * Maps to the official Google Cloud Search endpoint GET /v1/stats/user.
 */
class GoogleCloudSearchStatsGetUser extends AbstractGoogleCloudSearchTool
{
    protected const NAME = 'google_cloud_search_stats_get_user';
    protected const DESCRIPTION = 'Stats Get User

Official Google Cloud Search endpoint: GET /v1/stats/user
Get the users statistics for customer.';
    protected const PARAMETERS = array (
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
    protected const PATH = '/v1/stats/user';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
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
