<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

/**
 * Tasklists List.
 *
 * Maps to the official Google Tasks endpoint GET /tasks/v1/users/@me/lists.
 */
class GoogleTasksTasklistsList extends AbstractGoogleTasksTool
{
    protected const NAME = 'google_tasks_tasklists_list';
    protected const DESCRIPTION = 'Tasklists List

Official Google Tasks endpoint: GET /tasks/v1/users/@me/lists
Returns all the authenticated user\'s task lists. A user can have up to 2000 lists at a time.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Tasks method. Known keys: maxResults, pageToken.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Maximum number of task lists returned on one page. Optional. The default is 1000 (max allowed: 1000).',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Token specifying the result page to return. Optional.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/tasks/v1/users/@me/lists';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxResults',
  1 => 'pageToken',
);
    protected const BODY_REQUIRED = false;
}
