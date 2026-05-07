<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Reset activity.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/activities-deprecated/reset.
 */
class TemporalResetActivity extends AbstractTemporalTool
{
    protected const NAME = 'temporal_reset_activity';
    protected const DESCRIPTION = 'Reset activity

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/activities-deprecated/reset

ResetActivity resets the execution of an activity specified by its ID or type.
 If there are multiple pending activities of the provided type - all of them will be reset.

 Resetting an activity means:
 * number of attempts will be reset to 0.
 * activity timeouts will be reset.
 * if the activity is waiting for retry, and it is not paused or \'keep_paused\' is not provided:
    it will be scheduled immediately (* see \'jitter\' flag),

 Flags:

 \'jitter\': the activity will be scheduled at a random time within the jitter duration.
 If the activity currently paused it will be unpaused, unless \'keep_paused\' flag is provided.
 \'reset_heartbeats\': the activity heartbeat timer and heartbeats will be reset.
 \'keep_paused\': if the activity is paused, it will remain paused.

 Returns a `NotFound` error if there is no pending activity with the provided ID or type.
 This API will be deprecated soon and replaced with a newer ResetActivityExecution that is better named and
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
    protected const PATH = '/api/v1/namespaces/{namespace}/activities-deprecated/reset';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
