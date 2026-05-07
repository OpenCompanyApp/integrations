<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Unpause activity.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/activities-deprecated/unpause.
 */
class TemporalUnpauseActivity2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_unpause_activity_2';
    protected const DESCRIPTION = 'Unpause activity

Official Temporal endpoint: POST /namespaces/{namespace}/activities-deprecated/unpause

UnpauseActivity unpauses the execution of an activity specified by its ID or type.
 If there are multiple pending activities of the provided type - all of them will be unpaused.

 If activity is not paused, this call will have no effect.
 If the activity was paused while waiting for retry, it will be scheduled immediately (* see \'jitter\' flag).
 Once the activity is unpaused, all timeout timers will be regenerated.

 Flags:
 \'jitter\': the activity will be scheduled at a random time within the jitter duration.
 \'reset_attempts\': the number of attempts will be reset.
 \'reset_heartbeat\': the activity heartbeat timer and heartbeats will be reset.

 Returns a `NotFound` error if there is no pending activity with the provided ID or type
 This API will be deprecated soon and replaced with a newer UnpauseActivityExecution that is better named and
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
    protected const PATH = '/namespaces/{namespace}/activities-deprecated/unpause';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
