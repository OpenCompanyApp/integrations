<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Record activity task heartbeat.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/activity-heartbeat.
 */
class TemporalRecordActivityTaskHeartbeat2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_record_activity_task_heartbeat_2';
    protected const DESCRIPTION = 'Record activity task heartbeat

Official Temporal endpoint: POST /namespaces/{namespace}/activity-heartbeat

RecordActivityTaskHeartbeat is optionally called by workers while they execute activities.

 If a worker fails to heartbeat within the `heartbeat_timeout` interval for the activity task,
 then the current attempt times out. Depending on RetryPolicy, this may trigger a retry or
 time out the activity.

 For workflow activities, an `ACTIVITY_TASK_TIMED_OUT` event will be written to the workflow
 history. Calling `RecordActivityTaskHeartbeat` will fail with `NotFound` in such situations,
 in that event, the SDK should request cancellation of the activity.

 The request may contain response `details` which will be persisted by the server and may be
 used by the activity to checkpoint progress. The `cancel_requested` field in the response
 indicates whether cancellation has been requested for the activity.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/activity-heartbeat';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
