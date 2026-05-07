<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Get service uptime chart.
 *
 * Maps to the official Rootly endpoint get /v1/services/{id}/uptime_chart.
 */
class RootlyGetServiceUptimeChart extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_service_uptime_chart';
    protected const DESCRIPTION = 'Get service uptime chart

Official Rootly endpoint: GET /v1/services/{id}/uptime_chart

Get service uptime chart';
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
    protected const PATH = '/v1/services/{id}/uptime_chart';
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
