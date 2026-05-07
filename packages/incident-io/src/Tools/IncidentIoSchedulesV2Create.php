<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Create Schedules V2.
 *
 * Maps to the official incident.io endpoint post /v2/schedules.
 */
class IncidentIoSchedulesV2Create extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_schedules_v2_create';
    protected const DESCRIPTION = 'Create Schedules V2

Official incident.io endpoint: POST /v2/schedules

Create a new schedule.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/schedules';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
