<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get worker versioning rules.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/task-queues/{taskQueue}/worker-versioning-rules.
 */
class TemporalGetWorkerVersioningRules extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_worker_versioning_rules';
    protected const DESCRIPTION = 'Get worker versioning rules

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/task-queues/{taskQueue}/worker-versioning-rules

Fetches the Build ID assignment and redirect rules for a Task Queue.
 WARNING: Worker Versioning is not yet stable and the API and behavior may change incompatibly.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'task_queue' => array (
  'type' => 'string',
  'description' => 'taskQueue parameter.',
  'required' => true,
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/task-queues/{taskQueue}/worker-versioning-rules';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'taskQueue' => 'task_queue',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
