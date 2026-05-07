<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * CreateScheduleReplica Schedules V2.
 *
 * Maps to the official incident.io endpoint post /v2/schedules/{schedule_id}/replicas.
 */
class IncidentIoSchedulesV2CreateScheduleReplica extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_schedules_v2_create_schedule_replica';
    protected const DESCRIPTION = 'CreateScheduleReplica Schedules V2

Official incident.io endpoint: POST /v2/schedules/{schedule_id}/replicas

Create a new schedule replica.';
    protected const PARAMETERS = array (
  'schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'The schedule to create a replica for',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the incident.io API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/schedules/{schedule_id}/replicas';
    protected const PATH_PARAMS = array (
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
