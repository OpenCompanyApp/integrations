<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * Destroy Schedules V2.
 *
 * Maps to the official incident.io endpoint delete /v2/schedules/{id}.
 */
class IncidentIoSchedulesV2Destroy extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_schedules_v2_destroy';
    protected const DESCRIPTION = 'Destroy Schedules V2

Official incident.io endpoint: DELETE /v2/schedules/{id}

Archives a single schedule. Will fail if the schedule has active replicas — remove all replicas before deleting.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'Unique internal ID of the schedule',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
