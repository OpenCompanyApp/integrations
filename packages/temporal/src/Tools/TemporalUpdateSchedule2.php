<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Update schedule.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/schedules/{scheduleId}/update.
 */
class TemporalUpdateSchedule2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_update_schedule_2';
    protected const DESCRIPTION = 'Update schedule

Official Temporal endpoint: POST /namespaces/{namespace}/schedules/{scheduleId}/update

Changes the configuration or state of an existing schedule.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'The namespace of the schedule to update.',
  'required' => true,
),
  'schedule_id' => array (
  'type' => 'string',
  'description' => 'The id of the schedule to update.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/schedules/{scheduleId}/update';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'scheduleId' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
