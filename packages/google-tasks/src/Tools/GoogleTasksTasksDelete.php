<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasks Delete.
 *
 * Maps to the official Google Tasks endpoint DELETE /tasks/v1/lists/{tasklist}/tasks/{task}.
 */
class GoogleTasksTasksDelete extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasks_delete';
    protected const DESCRIPTION = 'Tasks Delete

Official Google Tasks endpoint: DELETE /tasks/v1/lists/{tasklist}/tasks/{task}
Deletes the specified task from the task list. If the task is assigned, both the assigned task and the original task (in Docs, Chat Spaces) are deleted. To delete the assigned task only, navigate to the assignment surface and unassign the task from there.';
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
    protected const METHOD = 'DELETE';
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
