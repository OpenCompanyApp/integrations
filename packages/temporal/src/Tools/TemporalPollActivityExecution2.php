<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Poll activity execution.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/activities/{activityId}/outcome.
 */
class TemporalPollActivityExecution2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_poll_activity_execution_2';
    protected const DESCRIPTION = 'Poll activity execution

Official Temporal endpoint: GET /namespaces/{namespace}/activities/{activityId}/outcome

PollActivityExecution long-polls for an activity execution to complete and returns the
 outcome (result or failure).';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/activities/{activityId}/outcome';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'activityId' => 'activity_id',
);
    protected const QUERY_PARAMS = array (
  'runId' => 'run_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
