<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasks Insert.
 *
 * Maps to the official Google Tasks endpoint POST /tasks/v1/lists/{tasklist}/tasks.
 */
class GoogleTasksTasksInsert extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasks_insert';
    protected const DESCRIPTION = 'Tasks Insert

Official Google Tasks endpoint: POST /tasks/v1/lists/{tasklist}/tasks
Creates a new task on the specified task list. Tasks assigned from Docs or Chat Spaces cannot be inserted from Tasks Public API; they can only be created by assigning them from Docs or Chat Spaces. A user can have up to 20,000 non-hidden tasks per list and up to 100,000 tasks in total at a time.';
    protected const PARAMETERS = array (
  'tasklist' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tasklist` from the official Google Tasks API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Tasks method. Known keys: parent, previous.',
  ),
  'parent' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Parent task identifier. If the task is created at the top level, this parameter is omitted. An assigned task cannot be a parent task, nor can it have a parent. Setting the parent to an assigned task results in failure of the request. Optional.',
  ),
  'previous' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Previous sibling task identifier. If the task is created at the first position among its siblings, this parameter is omitted. Optional.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Tasks API `Task` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/tasks/v1/lists/{tasklist}/tasks';
    protected const PATH_PARAMS = array (
  0 => 'tasklist',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'parent',
  1 => 'previous',
);
    protected const BODY_REQUIRED = true;
}
