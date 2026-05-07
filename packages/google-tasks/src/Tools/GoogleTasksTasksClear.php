<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasks Clear.
 *
 * Maps to the official Google Tasks endpoint POST /tasks/v1/lists/{tasklist}/clear.
 */
class GoogleTasksTasksClear extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasks_clear';
    protected const DESCRIPTION = 'Tasks Clear

Official Google Tasks endpoint: POST /tasks/v1/lists/{tasklist}/clear
Clears all completed tasks from the specified task list. The affected tasks will be marked as \'hidden\' and no longer be returned by default when retrieving all tasks for a task list.';
    protected const PARAMETERS = array (
  'tasklist' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tasklist` from the official Google Tasks API method.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/tasks/v1/lists/{tasklist}/clear';
    protected const PATH_PARAMS = array (
  0 => 'tasklist',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
