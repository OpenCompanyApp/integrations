<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * List schedule matching times.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/schedules/{scheduleId}/matching-times.
 */
class TemporalListScheduleMatchingTimes extends AbstractTemporalTool
{
    protected const NAME = 'temporal_list_schedule_matching_times';
    protected const DESCRIPTION = 'List schedule matching times

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/schedules/{scheduleId}/matching-times

Lists matching times within a range.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'The namespace of the schedule to query.',
  'required' => true,
),
  'schedule_id' => array (
  'type' => 'string',
  'description' => 'The id of the schedule to query.',
  'required' => true,
),
  'start_time' => array (
  'type' => 'string',
  'description' => 'Time range to query.',
),
  'end_time' => array (
  'type' => 'string',
  'description' => 'endTime parameter.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/schedules/{scheduleId}/matching-times';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'scheduleId' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
  'startTime' => 'start_time',
  'endTime' => 'end_time',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
