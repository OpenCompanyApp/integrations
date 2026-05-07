<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ShowScheduleReplica Schedules V2.
 *
 * Maps to the official incident.io endpoint get /v2/schedules/{schedule_id}/replicas/{id}.
 */
class IncidentIoSchedulesV2ShowScheduleReplica extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_schedules_v2_show_schedule_replica';
    protected const DESCRIPTION = 'ShowScheduleReplica Schedules V2

Official incident.io endpoint: GET /v2/schedules/{schedule_id}/replicas/{id}

Get a single schedule replica.';
    protected const PARAMETERS = array (
  'schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'The parent schedule ID',
    'required' => true,
  ),
  'id' =>
  array (
    'type' => 'string',
    'description' => 'The replica ID to show',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/schedules/{schedule_id}/replicas/{id}';
    protected const PATH_PARAMS = array (
  'schedule_id' => 'schedule_id',
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
