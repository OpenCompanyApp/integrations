<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Patch schedule.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/schedules/{scheduleId}/patch.
 */
class TemporalPatchSchedule extends AbstractTemporalTool
{
    protected const NAME = 'temporal_patch_schedule';
    protected const DESCRIPTION = 'Patch schedule

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/schedules/{scheduleId}/patch

Makes a specific change to a schedule or triggers an immediate action.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'The namespace of the schedule to patch.',
  'required' => true,
),
  'schedule_id' => array (
  'type' => 'string',
  'description' => 'The id of the schedule to patch.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/schedules/{scheduleId}/patch';
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
