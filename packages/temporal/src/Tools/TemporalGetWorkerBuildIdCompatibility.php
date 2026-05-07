<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get worker build id compatibility.
 *
 * Maps to the official Temporal endpoint get /api/v1/namespaces/{namespace}/task-queues/{taskQueue}/worker-build-id-compatibility.
 */
class TemporalGetWorkerBuildIdCompatibility extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_worker_build_id_compatibility';
    protected const DESCRIPTION = 'Get worker build id compatibility

Official Temporal endpoint: GET /api/v1/namespaces/{namespace}/task-queues/{taskQueue}/worker-build-id-compatibility

Deprecated. Use `GetWorkerVersioningRules`.
 Fetches the worker build id versioning sets for a task queue.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'task_queue' => array (
  'type' => 'string',
  'description' => 'Must be set, the task queue to interrogate about worker id compatibility.',
  'required' => true,
),
  'max_sets' => array (
  'type' => 'integer',
  'description' => 'Limits how many compatible sets will be returned. Specify 1 to only return the current
 default major version set. 0 returns all sets.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/task-queues/{taskQueue}/worker-build-id-compatibility';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'taskQueue' => 'task_queue',
);
    protected const QUERY_PARAMS = array (
  'maxSets' => 'max_sets',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
