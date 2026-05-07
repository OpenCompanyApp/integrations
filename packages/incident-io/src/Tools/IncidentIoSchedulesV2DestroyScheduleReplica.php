<?php

namespace OpenCompany\Integrations\IncidentIo\Tools;

/**
 * DestroyScheduleReplica Schedules V2.
 *
 * Maps to the official incident.io endpoint delete /v2/schedules/{schedule_id}/replicas/{id}.
 */
class IncidentIoSchedulesV2DestroyScheduleReplica extends AbstractIncidentIoTool
{
    protected const NAME = 'incident_io_schedules_v2_destroy_schedule_replica';
    protected const DESCRIPTION = 'DestroyScheduleReplica Schedules V2

Official incident.io endpoint: DELETE /v2/schedules/{schedule_id}/replicas/{id}

Archives a single schedule replica, stopping incident.io from syncing on-call shifts to the external provider.

As with disabling mirroring via the UI, this will remove any upcoming overrides that incident.io has created in the external schedule, restoring it to its original state. If multiple replicas target the same external schedule, overrides are only removed when the last replica pointing to that schedule is deleted.

Note: override cleanup is supported for PagerDuty and Jira Service Management. Opsgenie does not support programmatic override deletion, so overrides must be removed manually.';
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
    'description' => 'The replica ID to archive',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
