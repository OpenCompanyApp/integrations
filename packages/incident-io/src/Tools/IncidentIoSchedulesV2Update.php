<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Update Schedules V2.
 *
 * Maps to the official incident.io endpoint put /v2/schedules/{id}.
 */
class IncidentIoSchedulesV2Update extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_schedules_v2_update';
    protected const DESCRIPTION = 'Update Schedules V2

Official incident.io endpoint: PUT /v2/schedules/{id}

Update a schedule.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'The schedule ID to update.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/v2/schedules/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
