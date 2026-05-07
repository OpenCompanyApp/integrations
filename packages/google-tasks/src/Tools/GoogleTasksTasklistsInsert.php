<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasklists Insert.
 *
 * Maps to the official Google Tasks endpoint POST /tasks/v1/users/@me/lists.
 */
class GoogleTasksTasklistsInsert extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasklists_insert';
    protected const DESCRIPTION = 'Tasklists Insert

Official Google Tasks endpoint: POST /tasks/v1/users/@me/lists
Creates a new task list and adds it to the authenticated user\'s task lists. A user can have up to 2000 lists at a time.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Tasks API `TaskList` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/tasks/v1/users/@me/lists';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
