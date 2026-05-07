<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasklists Get.
 *
 * Maps to the official Google Tasks endpoint GET /tasks/v1/users/@me/lists/{tasklist}.
 */
class GoogleTasksTasklistsGet extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasklists_get';
    protected const DESCRIPTION = 'Tasklists Get

Official Google Tasks endpoint: GET /tasks/v1/users/@me/lists/{tasklist}
Returns the authenticated user\'s specified task list.';
    protected const PARAMETERS = array (
  'tasklist' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tasklist` from the official Google Tasks API method.',
  ),
);
    protected const METHOD = 'GET';
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
