<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasks Move.
 *
 * Maps to the official Google Tasks endpoint POST /tasks/v1/lists/{tasklist}/tasks/{task}/move.
 */
class GoogleTasksTasksMove extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasks_move';
    protected const DESCRIPTION = 'Tasks Move

Official Google Tasks endpoint: POST /tasks/v1/lists/{tasklist}/tasks/{task}/move
Moves the specified task to another position in the destination task list. If the destination list is not specified, the task is moved within its current list. This can include putting it as a child task under a new parent and/or move it to a different position among its sibling tasks. A user can have up to 2,000 subtasks per task.';
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
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Tasks method. Known keys: previous, destinationTasklist, parent.',
  ),
  'previous' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. New previous sibling task identifier. If the task is moved to the first position among its siblings, this parameter is omitted. The task set as previous must exist in the task list and can not be hidden. Exceptions: 1. Tasks that are both completed and hidden can only be moved to position 0, so the previous field must be empty.',
  ),
  'destinationTasklist' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. Destination task list identifier. If set, the task is moved from tasklist to the destinationTasklist list. Otherwise the task is moved within its current list. Recurrent tasks cannot currently be moved between lists.',
  ),
  'parent' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. New parent task identifier. If the task is moved to the top level, this parameter is omitted. The task set as parent must exist in the task list and can not be hidden. Exceptions: 1. Assigned and repeating tasks cannot be set as parent tasks (have subtasks), or be moved under a parent task (become subtasks). 2. Tasks that are both completed and hidden cannot be nested, so the parent field must be empty.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/tasks/v1/lists/{tasklist}/tasks/{task}/move';
    protected const PATH_PARAMS = array (
  0 => 'tasklist',
  1 => 'task',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'previous',
  1 => 'destinationTasklist',
  2 => 'parent',
);
    protected const BODY_REQUIRED = false;
}
