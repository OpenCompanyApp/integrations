<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Get functionality uptime chart.
 *
 * Maps to the official Rootly endpoint get /v1/functionalities/{id}/uptime_chart.
 */
class RootlyGetFunctionalityUptimeChart extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_functionality_uptime_chart';
    protected const DESCRIPTION = 'Get functionality uptime chart

Official Rootly endpoint: GET /v1/functionalities/{id}/uptime_chart

Get functionality uptime chart';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'period' =>
  array (
    'type' => 'string',
    'description' => 'period parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/functionalities/{id}/uptime_chart';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
  'period' => 'period',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
