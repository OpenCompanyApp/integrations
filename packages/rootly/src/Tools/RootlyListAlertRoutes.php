<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List alert routes.
 *
 * Maps to the official Rootly endpoint get /v1/alert_routes.
 */
class RootlyListAlertRoutes extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_alert_routes';
    protected const DESCRIPTION = 'List alert routes

Official Rootly endpoint: GET /v1/alert_routes

List all alert routes for the current team with filtering and pagination. **Note: This endpoint requires access to Advanced Alert Routing. If you\'re unsure whether you have access to this feature, please contact Rootly customer support.**';
    protected const PARAMETERS = array (
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
  'filter_search' =>
  array (
    'type' => 'string',
    'description' => 'filter[search] parameter.',
  ),
  'filter_name' =>
  array (
    'type' => 'string',
    'description' => 'filter[name] parameter.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'sort parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alert_routes';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[search]' => 'filter_search',
  'filter[name]' => 'filter_name',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
