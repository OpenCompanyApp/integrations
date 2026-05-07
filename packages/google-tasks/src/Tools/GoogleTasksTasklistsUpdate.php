<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasklists Update.
 *
 * Maps to the official Google Tasks endpoint PUT /tasks/v1/users/@me/lists/{tasklist}.
 */
class GoogleTasksTasklistsUpdate extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasklists_update';
    protected const DESCRIPTION = 'Tasklists Update

Official Google Tasks endpoint: PUT /tasks/v1/users/@me/lists/{tasklist}
Updates the authenticated user\'s specified task list.';
    protected const PARAMETERS = array (
  'tasklist' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tasklist` from the official Google Tasks API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Tasks API `TaskList` schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/tasks/v1/users/@me/lists/{tasklist}';
    protected const PATH_PARAMS = array (
  0 => 'tasklist',
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
