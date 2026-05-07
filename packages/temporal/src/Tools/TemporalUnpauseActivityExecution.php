<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Unpause activity execution.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/activities/{activityId}/unpause.
 */
class TemporalUnpauseActivityExecution extends AbstractTemporalTool
{
    protected const NAME = 'temporal_unpause_activity_execution';
    protected const DESCRIPTION = 'Unpause activity execution

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/activities/{activityId}/unpause

UnpauseActivityExecution unpauses the execution of an activity specified by its ID.
 This API can be used to target a workflow activity or a standalone activity.

 If activity is not paused, this call will have no effect.
 If the activity was paused while waiting for retry, it will be scheduled immediately (* see \'jitter\' flag).
 Once the activity is unpaused, all timeout timers will be regenerated.

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
    protected const PATH = '/api/v1/namespaces/{namespace}/activities/{activityId}/unpause';
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
