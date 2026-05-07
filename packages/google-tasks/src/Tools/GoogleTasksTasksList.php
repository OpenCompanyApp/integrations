<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasks List.
 *
 * Maps to the official Google Tasks endpoint GET /tasks/v1/lists/{tasklist}/tasks.
 */
class GoogleTasksTasksList extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasks_list';
    protected const DESCRIPTION = 'Tasks List

Official Google Tasks endpoint: GET /tasks/v1/lists/{tasklist}/tasks
Returns all tasks in the specified task list. Doesn\'t return assigned tasks by default (from Docs, Chat Spaces). A user can have up to 20,000 non-hidden tasks per list and up to 100,000 tasks in total at a time.';
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
    'description' => 'Query string parameters accepted by the official Tasks method. Known keys: pageToken, showDeleted, maxResults, showCompleted, showAssigned, updatedMin, showHidden, completedMax, dueMax, completedMin, dueMin.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token specifying the result page to return. Optional.',
  ),
  'showDeleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Flag indicating whether deleted tasks are returned in the result. Optional. The default is False.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of tasks returned on one page. Optional. The default is 20 (max allowed: 100).',
  ),
  'showCompleted' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Flag indicating whether completed tasks are returned in the result. Note that showHidden must also be True to show tasks completed in first party clients, such as the web UI and Google\'s mobile apps. Optional. The default is True.',
  ),
  'showAssigned' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Optional. Flag indicating whether tasks assigned to the current user are returned in the result. Optional. The default is False.',
  ),
  'updatedMin' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lower bound for a task\'s last modification time (as a RFC 3339 timestamp) to filter by. Optional. The default is not to filter by last modification time.',
  ),
  'showHidden' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Flag indicating whether hidden tasks are returned in the result. Optional. The default is False.',
  ),
  'completedMax' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Upper bound for a task\'s completion date (as a RFC 3339 timestamp) to filter by. Optional. The default is not to filter by completion date.',
  ),
  'dueMax' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Upper bound for a task\'s due date (as a RFC 3339 timestamp) to filter by. Optional. The default is not to filter by due date.',
  ),
  'completedMin' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lower bound for a task\'s completion date (as a RFC 3339 timestamp) to filter by. Optional. The default is not to filter by completion date.',
  ),
  'dueMin' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Lower bound for a task\'s due date (as a RFC 3339 timestamp) to filter by. Optional. The default is not to filter by due date.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/tasks/v1/lists/{tasklist}/tasks';
    protected const PATH_PARAMS = array (
  0 => 'tasklist',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'showDeleted',
  2 => 'maxResults',
  3 => 'showCompleted',
  4 => 'showAssigned',
  5 => 'updatedMin',
  6 => 'showHidden',
  7 => 'completedMax',
  8 => 'dueMax',
  9 => 'completedMin',
  10 => 'dueMin',
);
    protected const BODY_REQUIRED = false;
}
