<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasklists Patch.
 *
 * Maps to the official Google Tasks endpoint PATCH /tasks/v1/users/@me/lists/{tasklist}.
 */
class GoogleTasksTasklistsPatch extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasklists_patch';
    protected const DESCRIPTION = 'Tasklists Patch

Official Google Tasks endpoint: PATCH /tasks/v1/users/@me/lists/{tasklist}
Updates the authenticated user\'s specified task list. This method supports patch semantics.';
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
    protected const METHOD = 'PATCH';
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
