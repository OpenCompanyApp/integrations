<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Show Schedules V2.
 *
 * Maps to the official incident.io endpoint get /v2/schedules/{id}.
 */
class IncidentIoSchedulesV2Show extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_schedules_v2_show';
    protected const DESCRIPTION = 'Show Schedules V2

Official incident.io endpoint: GET /v2/schedules/{id}

Get a single schedule.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique internal ID of the schedule',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/schedules/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
