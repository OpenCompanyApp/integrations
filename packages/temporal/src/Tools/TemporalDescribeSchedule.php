<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe schedule.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/schedules/{scheduleId}.
 */
class TemporalDescribeSchedule extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_schedule';
    protected const DESCRIPTION = 'Describe schedule

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/schedules/{scheduleId}

Returns the schedule description and current state of an existing schedule.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'The namespace of the schedule to describe.',
  'required' => true,
),
  'schedule_id' => array (
  'type' => 'string',
  'description' => 'The id of the schedule to describe.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/schedules/{scheduleId}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'scheduleId' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
