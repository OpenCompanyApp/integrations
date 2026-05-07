<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Describe task queue.
 *
 * Maps to the official Temporal endpoint get /namespaces/{namespace}/task-queues/{task_queue.name}.
 */
class TemporalDescribeTaskQueue2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_describe_task_queue_2';
    protected const DESCRIPTION = 'Describe task queue

Official Temporal endpoint: GET /namespaces/{namespace}/task-queues/{task_queue.name}

DescribeTaskQueue returns the following information about the target task queue, broken down by Build ID:
   - List of pollers
   - Workflow Reachability status
   - Backlog info for Workflow and/or Activity tasks';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'task_queue_name' => array (
  'type' => 'string',
  'description' => 'taskQueue.name parameter.',
),
  'task_queue_kind' => array (
  'type' => 'string',
  'description' => 'Default: TASK_QUEUE_KIND_NORMAL.',
  'enum' => array (
  'TASK_QUEUE_KIND_UNSPECIFIED',
  'TASK_QUEUE_KIND_NORMAL',
  'TASK_QUEUE_KIND_STICKY',
  'TASK_QUEUE_KIND_WORKER_COMMANDS',
),
),
  'task_queue_normal_name' => array (
  'type' => 'string',
  'description' => 'Iff kind == TASK_QUEUE_KIND_STICKY, then this field contains the name of
 the normal task queue that the sticky worker is running on.',
),
  'task_queue_type' => array (
  'type' => 'string',
  'description' => 'If unspecified (TASK_QUEUE_TYPE_UNSPECIFIED), then default value (TASK_QUEUE_TYPE_WORKFLOW) will be used.
 Only supported in default mode (use `task_queue_types` in ENHANCED mode instead).',
  'enum' => array (
  'TASK_QUEUE_TYPE_UNSPECIFIED',
  'TASK_QUEUE_TYPE_WORKFLOW',
  'TASK_QUEUE_TYPE_ACTIVITY',
  'TASK_QUEUE_TYPE_NEXUS',
),
),
  'report_stats' => array (
  'type' => 'boolean',
  'description' => 'Report stats for the requested task queue type(s).',
),
  'report_config' => array (
  'type' => 'boolean',
  'description' => 'Report Task Queue Config',
),
  'include_task_queue_status' => array (
  'type' => 'boolean',
  'description' => 'Deprecated, use `report_stats` instead.
 If true, the task queue status will be included in the response.',
),
  'api_mode' => array (
  'type' => 'string',
  'description' => 'Deprecated. ENHANCED mode is also being deprecated.
 Select the API mode to use for this request: DEFAULT mode (if unset) or ENHANCED mode.
 Consult the documentation for each field to understand which mode it is supported in.',
  'enum' => array (
  'DESCRIBE_TASK_QUEUE_MODE_UNSPECIFIED',
  'DESCRIBE_TASK_QUEUE_MODE_ENHANCED',
),
),
  'versions_build_ids' => array (
  'type' => 'array',
  'description' => 'Include specific Build IDs.',
),
  'versions_unversioned' => array (
  'type' => 'boolean',
  'description' => 'Include the unversioned queue.',
),
  'versions_all_active' => array (
  'type' => 'boolean',
  'description' => 'Include all active versions. A version is considered active if, in the last few minutes,
 it has had new tasks or polls, or it has been the subject of certain task queue API calls.',
),
  'task_queue_types' => array (
  'type' => 'array',
  'description' => 'Deprecated (as part of the ENHANCED mode deprecation).
 Task queue types to report info about. If not specified, all types are considered.',
),
  'report_pollers' => array (
  'type' => 'boolean',
  'description' => 'Deprecated (as part of the ENHANCED mode deprecation).
 Report list of pollers for requested task queue types and versions.',
),
  'report_task_reachability' => array (
  'type' => 'boolean',
  'description' => 'Deprecated (as part of the ENHANCED mode deprecation).
 Report task reachability for the requested versions and all task types (task reachability is not reported
 per task type).',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/namespaces/{namespace}/task-queues/{task_queue.name}';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'task_queue.name' => 'task_queue_name',
);
    protected const QUERY_PARAMS = array (
  'taskQueue.name' => 'task_queue_name',
  'taskQueue.kind' => 'task_queue_kind',
  'taskQueue.normalName' => 'task_queue_normal_name',
  'taskQueueType' => 'task_queue_type',
  'reportStats' => 'report_stats',
  'reportConfig' => 'report_config',
  'includeTaskQueueStatus' => 'include_task_queue_status',
  'apiMode' => 'api_mode',
  'versions.buildIds' => 'versions_build_ids',
  'versions.unversioned' => 'versions_unversioned',
  'versions.allActive' => 'versions_all_active',
  'taskQueueTypes' => 'task_queue_types',
  'reportPollers' => 'report_pollers',
  'reportTaskReachability' => 'report_task_reachability',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
