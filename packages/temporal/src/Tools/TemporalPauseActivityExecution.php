<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Pause activity execution.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/activities/{activityId}/pause.
 */
class TemporalPauseActivityExecution extends AbstractTemporalTool
{
    protected const NAME = 'temporal_pause_activity_execution';
    protected const DESCRIPTION = 'Pause activity execution

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/activities/{activityId}/pause

PauseActivityExecution pauses the execution of an activity specified by its ID.
 This API can be used to target a workflow activity or a standalone activity

 Pausing an activity means:
 - If the activity is currently waiting for a retry or is running and subsequently fails,
   it will not be rescheduled until it is unpaused.
 - If the activity is already paused, calling this method will have no effect.
 - If the activity is running and finishes successfully, the activity will be completed.
 - If the activity is running and finishes with failure:
   * if there is no retry left - the activity will be completed.
   * if there are more retries left - the activity will be paused.
 For long-running activities:
 - activities in paused state will send a cancellation with "activity_paused" set to \'true\' in response to \'RecordActivityTaskHeartbeat\'.

 Returns a `NotFound` error if there is no pending activity with the provided ID';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace of the workflow which scheduled this activity.',
  'required' => true,
),
  'activity_id' => array (
  'type' => 'string',
  'description' => 'The ID of the activity to target.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/activities/{activityId}/pause';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'activityId' => 'activity_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
