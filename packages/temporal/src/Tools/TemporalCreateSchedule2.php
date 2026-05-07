<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Create schedule.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/schedules/{scheduleId}.
 */
class TemporalCreateSchedule2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_create_schedule_2';
    protected const DESCRIPTION = 'Create schedule

Official Temporal endpoint: POST /namespaces/{namespace}/schedules/{scheduleId}

Creates a new schedule.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'The namespace the schedule should be created in.',
  'required' => true,
),
  'schedule_id' => array (
  'type' => 'string',
  'description' => 'The id of the new schedule.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/schedules/{scheduleId}';
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
