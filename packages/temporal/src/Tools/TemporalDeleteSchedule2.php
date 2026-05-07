<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Delete schedule.
 *
 * Maps to the official Temporal endpoint delete /namespaces/{namespace}/schedules/{scheduleId}.
 */
class TemporalDeleteSchedule2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_delete_schedule_2';
    protected const DESCRIPTION = 'Delete schedule

Official Temporal endpoint: DELETE /namespaces/{namespace}/schedules/{scheduleId}

Deletes a schedule, removing it from the system.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'The namespace of the schedule to delete.',
  'required' => true,
),
  'schedule_id' => array (
  'type' => 'string',
  'description' => 'The id of the schedule to delete.',
  'required' => true,
),
  'identity' => array (
  'type' => 'string',
  'description' => 'The identity of the client who initiated this request.',
),
);
    protected const METHOD = 'delete';
    protected const PATH = '/namespaces/{namespace}/schedules/{scheduleId}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'scheduleId' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
  'identity' => 'identity',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
