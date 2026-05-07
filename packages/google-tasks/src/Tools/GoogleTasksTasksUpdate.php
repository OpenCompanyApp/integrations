<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasks Update.
 *
 * Maps to the official Google Tasks endpoint PUT /tasks/v1/lists/{tasklist}/tasks/{task}.
 */
class GoogleTasksTasksUpdate extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasks_update';
    protected const DESCRIPTION = 'Tasks Update

Official Google Tasks endpoint: PUT /tasks/v1/lists/{tasklist}/tasks/{task}
Updates the specified task.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Tasks API `Task` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/tasks/v1/lists/{tasklist}/tasks/{task}';
    protected const PATH_PARAMS = array (
  0 => 'tasklist',
  1 => 'task',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
