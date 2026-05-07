<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Pause activity.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/activities-deprecated/pause.
 */
class TemporalPauseActivity2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_pause_activity_2';
    protected const DESCRIPTION = 'Pause activity

Official Temporal endpoint: POST /namespaces/{namespace}/activities-deprecated/pause

PauseActivity pauses the execution of an activity specified by its ID or type.
 If there are multiple pending activities of the provided type - all of them will be paused

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
 - The activity should respond to the cancellation accordingly.

 Returns a `NotFound` error if there is no pending activity with the provided ID or type
 This API will be deprecated soon and replaced with a newer PauseActivityExecution that is better named and
 structured to work well for standalone activities.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace of the workflow which scheduled this activity.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/activities-deprecated/pause';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
