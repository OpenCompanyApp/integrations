<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe activity execution.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/activities/{activityId}.
 */
class TemporalDescribeActivityExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_activity_execution_2';
    protected const DESCRIPTION = 'Describe activity execution

Official Temporal endpoint: GET /namespaces/{namespace}/activities/{activityId}

DescribeActivityExecution returns information about an activity execution.
 It can be used to:
 - Get current activity info without waiting
 - Long-poll for next state change and return new activity info
 Response can optionally include activity input or outcome (if the activity has completed).';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'activity_id' => array (
  'type' => 'string',
  'description' => 'activityId parameter.',
  'required' => true,
),
  'run_id' => array (
  'type' => 'string',
  'description' => 'Activity run ID. If empty the request targets the latest run.',
),
  'include_input' => array (
  'type' => 'boolean',
  'description' => 'Include the input field in the response.',
),
  'include_outcome' => array (
  'type' => 'boolean',
  'description' => 'Include the outcome (result/failure) in the response if the activity has completed.',
),
  'long_poll_token' => array (
  'type' => 'string',
  'description' => 'Token from a previous DescribeActivityExecutionResponse. If present, long-poll until activity
 state changes from the state encoded in this token. If absent, return current state immediately.
 If present, run_id must also be present.
 Note that activity state may change multiple times between requests, therefore it is not
 guaranteed that a client making a sequence of long-poll requests will see a complete
 sequence of state changes.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/activities/{activityId}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'activityId' => 'activity_id',
);
    protected const QUERY_PARAMS = array (
  'runId' => 'run_id',
  'includeInput' => 'include_input',
  'includeOutcome' => 'include_outcome',
  'longPollToken' => 'long_poll_token',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
