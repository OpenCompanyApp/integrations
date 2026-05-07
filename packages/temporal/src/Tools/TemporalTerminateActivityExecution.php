<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Terminate activity execution.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/activities/{activityId}/terminate.
 */
class TemporalTerminateActivityExecution extends AbstractTemporalTool
{
    protected const NAME = 'temporal_terminate_activity_execution';
    protected const DESCRIPTION = 'Terminate activity execution

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/activities/{activityId}/terminate

TerminateActivityExecution terminates an existing activity execution immediately.

 Termination does not reach the worker and the activity code cannot react to it. A terminated activity may have a
 running attempt.';
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
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/activities/{activityId}/terminate';
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
