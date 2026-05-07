<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * ListScheduleReplicas Schedules V2.
 *
 * Maps to the official incident.io endpoint get /v2/schedules/{schedule_id}/replicas.
 */
class IncidentIoSchedulesV2ListScheduleReplicas extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_schedules_v2_list_schedule_replicas';
    protected const DESCRIPTION = 'ListScheduleReplicas Schedules V2

Official incident.io endpoint: GET /v2/schedules/{schedule_id}/replicas

List all replicas for a schedule.';
    protected const PARAMETERS = array (
  'schedule_id' =>
  array (
    'type' => 'string',
    'description' => 'The schedule to list replicas for',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v2/schedules/{schedule_id}/replicas';
    protected const PATH_PARAMS = array (
  'schedule_id' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
