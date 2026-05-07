<?php

namespace OpenCompany\Integrations\Temporal\Tools;

/**
 * Update task queue config.
 *
 * Maps to the official Temporal endpoint post /namespaces/{namespace}/task-queues/{taskQueue}/update-config.
 */
class TemporalUpdateTaskQueueConfig2 extends AbstractTemporalTool
{
    protected const NAME = 'temporal_update_task_queue_config_2';
    protected const DESCRIPTION = 'Update task queue config

Official Temporal endpoint: POST /namespaces/{namespace}/task-queues/{taskQueue}/update-config

Updates task queue configuration.
 For the overall queue rate limit: the rate limit set by this api overrides the worker-set rate limit,
 which uncouples the rate limit from the worker lifecycle.
 If the overall queue rate limit is unset, the worker-set rate limit takes effect.';
    protected const PARAMETERS = array (
  'namespace' => array (
  'type' => 'string',
  'description' => 'namespace parameter.',
  'required' => true,
),
  'task_queue' => array (
  'type' => 'string',
  'description' => 'Selects the task queue to update.',
  'required' => true,
),
  'body' => array (
  'type' => 'object',
  'description' => 'JSON request body matching the Temporal API schema.',
  'required' => true,
),
);
    protected const METHOD = 'post';
    protected const PATH = '/namespaces/{namespace}/task-queues/{taskQueue}/update-config';
    protected const PATH_PARAMS = array (
  'namespace' => 'namespace',
  'taskQueue' => 'task_queue',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
