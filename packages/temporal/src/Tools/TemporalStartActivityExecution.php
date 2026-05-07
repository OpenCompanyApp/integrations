<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Start activity execution.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/activities/{activityId}.
 */
class TemporalStartActivityExecution extends AbstractTemporalTool
{
    protected const NAME = 'temporal_start_activity_execution';
    protected const DESCRIPTION = 'Start activity execution

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/activities/{activityId}

StartActivityExecution starts a new activity execution.

 Returns an `ActivityExecutionAlreadyStarted` error if an instance already exists with same activity ID in this namespace
 unless permitted by the specified ID conflict policy.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'activity_id' => array (
  'type' => 'string',
  'description' => 'Identifier for this activity. Required. This identifier should be meaningful in the user\'s
 own system. It must be unique among activities in the same namespace, subject to the rules
 imposed by id_reuse_policy and id_conflict_policy.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/activities/{activityId}';
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
