<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Retrieves a dashboard panel.
 *
 * Maps to the official Rootly endpoint get /v1/dashboard_panels/{id}.
 */
class RootlyGetDashboardPanel extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_dashboard_panel';
    protected const DESCRIPTION = 'Retrieves a dashboard panel

Official Rootly endpoint: GET /v1/dashboard_panels/{id}

Retrieves a specific dashboard panel by id';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'range' =>
  array (
    'type' => 'string',
    'description' => 'Date range for panel data, ISO8601 timestamps separated by the word \'to\'. Ex: \'2022-06-19T11:28:46.029Z to 2022-07-18T21:58:46.029Z\'.',
  ),
  'period' =>
  array (
    'type' => 'string',
    'description' => 'The time period to group data by. Accepts \'day\', \'week\', and \'month\'',
  ),
  'time_zone' =>
  array (
    'type' => 'string',
    'description' => 'The time zone to use for period',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/dashboard_panels/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'range' => 'range',
  'period' => 'period',
  'time_zone' => 'time_zone',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
