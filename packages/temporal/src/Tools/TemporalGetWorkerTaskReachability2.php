<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Get worker task reachability.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/worker-task-reachability.
 */
class TemporalGetWorkerTaskReachability2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_get_worker_task_reachability_2';
    protected const DESCRIPTION = 'Get worker task reachability

Official Temporal endpoint: GET /namespaces/{namespace}/worker-task-reachability

Deprecated. Use `DescribeTaskQueue`.

 Fetches task reachability to determine whether a worker may be retired.
 The request may specify task queues to query for or let the server fetch all task queues mapped to the given
 build IDs.

 When requesting a large number of task queues or all task queues associated with the given build ids in a
 namespace, all task queues will be listed in the response but some of them may not contain reachability
 information due to a server enforced limit. When reaching the limit, task queues that reachability information
 could not be retrieved for will be marked with a single TASK_REACHABILITY_UNSPECIFIED entry. The caller may issue
 another call to get the reachability for those task queues.

 Open source users can adjust this limit by setting the server\'s dynamic config value for
 `limit.reachabilityTaskQueueScan` with the caveat that this call can strain the visibility store.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'build_ids' => array (
  'type' => 'array',
  'description' => 'Build ids to retrieve reachability for. An empty string will be interpreted as an unversioned worker.
 The number of build ids that can be queried in a single API call is limited.
 Open source users can adjust this limit by setting the server\'s dynamic config value for
 `limit.reachabilityQueryBuildIds` with the caveat that this call can strain the visibility store.',
),
  'task_queues' => array (
  'type' => 'array',
  'description' => 'Task queues to retrieve reachability for. Leave this empty to query for all task queues associated with given
 build ids in the namespace.
 Must specify at least one task queue if querying for an unversioned worker.
 The number of task queues that the server will fetch reachability information for is limited.
 See the `GetWorkerTaskReachabilityResponse` documentation for more information.',
),
  'reachability' => array (
  'type' => 'string',
  'description' => 'Type of reachability to query for.
 `TASK_REACHABILITY_NEW_WORKFLOWS` is always returned in the response.
 Use `TASK_REACHABILITY_EXISTING_WORKFLOWS` if your application needs to respond to queries on closed workflows.
 Otherwise, use `TASK_REACHABILITY_OPEN_WORKFLOWS`. Default is `TASK_REACHABILITY_EXISTING_WORKFLOWS` if left
 unspecified.
 See the TaskReachability docstring for information about each enum variant.',
  'enum' => array (
  'TASK_REACHABILITY_UNSPECIFIED',
  'TASK_REACHABILITY_NEW_WORKFLOWS',
  'TASK_REACHABILITY_EXISTING_WORKFLOWS',
  'TASK_REACHABILITY_OPEN_WORKFLOWS',
  'TASK_REACHABILITY_CLOSED_WORKFLOWS',
),
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/worker-task-reachability';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'buildIds' => 'build_ids',
  'taskQueues' => 'task_queues',
  'reachability' => 'reachability',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
