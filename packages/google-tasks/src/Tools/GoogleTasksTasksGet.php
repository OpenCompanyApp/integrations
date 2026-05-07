<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasks Get.
 *
 * Maps to the official Google Tasks endpoint GET /tasks/v1/lists/{tasklist}/tasks/{task}.
 */
class GoogleTasksTasksGet extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasks_get';
    protected const DESCRIPTION = 'Tasks Get

Official Google Tasks endpoint: GET /tasks/v1/lists/{tasklist}/tasks/{task}
Returns the specified task.';
    protected const PARAMETERS = array (
  'tasklist' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tasklist` from the official Google Tasks API method.',
  ),
  'task' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `task` from the official Google Tasks API method.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/tasks/v1/lists/{tasklist}/tasks/{task}';
    protected const PATH_PARAMS = array (
  0 => 'tasklist',
  1 => 'task',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
