<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Record activity task heartbeat by id.
 *
 * Maps to the official Temporal endpoint post /api/v1/namespaces/{namespace}/workflows/{workflowId}/activities/{activityId}/heartbeat.
 */
class TemporalRecordActivityTaskHeartbeatById2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_record_activity_task_heartbeat_by_id_2';
    protected const DESCRIPTION = 'Record activity task heartbeat by id

Official Temporal endpoint: POST /api/v1/namespaces/{namespace}/workflows/{workflowId}/activities/{activityId}/heartbeat

See `RecordActivityTaskHeartbeat`. This version allows clients to record heartbeats by
 namespace/workflow id/activity id instead of task token.

 (-- api-linter: core::0136::prepositions=disabled
     aip.dev/not-precedent: "By" is used to indicate request type. --)';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'Namespace of the workflow which scheduled this activity',
  'required' => true,
),
  'workflow_id' => array (
  'type' => 'string',
  'description' => 'Id of the workflow which scheduled this activity, leave empty to target a standalone activity',
  'required' => true,
),
  'activity_id' => array (
  'type' => 'string',
  'description' => 'Id of the activity we\'re heartbeating',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/workflows/{workflowId}/activities/{activityId}/heartbeat';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'workflowId' => 'workflow_id',
  'activityId' => 'activity_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
