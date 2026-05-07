<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Get team incidents chart.
 *
 * Maps to the official Rootly endpoint get /v1/teams/{id}/incidents_chart.
 */
class RootlyGetTeamIncidentsChart extends AbstractRootlyTool
{
    protected const NAME = 'rootly_get_team_incidents_chart';
    protected const DESCRIPTION = 'Get team incidents chart

Official Rootly endpoint: GET /v1/teams/{id}/incidents_chart

Get team incidents chart';
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
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/teams/{id}/incidents_chart';
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
