<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasklists Delete.
 *
 * Maps to the official Google Tasks endpoint DELETE /tasks/v1/users/@me/lists/{tasklist}.
 */
class GoogleTasksTasklistsDelete extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasklists_delete';
    protected const DESCRIPTION = 'Tasklists Delete

Official Google Tasks endpoint: DELETE /tasks/v1/users/@me/lists/{tasklist}
Deletes the authenticated user\'s specified task list. If the list contains assigned tasks, both the assigned tasks and the original tasks in the assignment surface (Docs, Chat Spaces) are deleted.';
    protected const PARAMETERS = array (
  'tasklist' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tasklist` from the official Google Tasks API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/tasks/v1/users/@me/lists/{tasklist}';
    protected const PATH_PARAMS = array (
  0 => 'tasklist',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
