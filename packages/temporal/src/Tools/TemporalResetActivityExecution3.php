<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Reset activity execution.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/activities/{activityId}/reset.
 */
class TemporalResetActivityExecution3 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_reset_activity_execution_3';
    protected const DESCRIPTION = 'Reset activity execution

Official Temporal endpoint: POST /namespaces/{namespace}/activities/{activityId}/reset

ResetActivityExecution resets the execution of an activity specified by its ID.
 This API can be used to target a workflow activity or a standalone activity.

 Resetting an activity means:
 * number of attempts will be reset to 0.
 * activity timeouts will be reset.
 * if the activity is waiting for retry, and it is not paused or \'keep_paused\' is not provided:
    it will be scheduled immediately (* see \'jitter\' flag)

 Returns a `NotFound` error if there is no pending activity with the provided ID or type.';
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
    protected const PATH = '/namespaces/{namespace}/activities/{activityId}/reset';
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
