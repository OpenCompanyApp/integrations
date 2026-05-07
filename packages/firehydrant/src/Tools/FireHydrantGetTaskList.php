<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get a task list.
 *
 * Maps to the official FireHydrant endpoint get /v1/task_lists/{task_list_id}.
 */
class FireHydrantGetTaskList extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_task_list';
    protected const DESCRIPTION = 'Get a task list

Official FireHydrant endpoint: GET /v1/task_lists/{task_list_id}

Retrieves a single task list by ID';
    protected const PARAMETERS = array (
  'task_list_id' =>
  array (
    'type' => 'string',
    'description' => 'task_list_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/task_lists/{task_list_id}';
    protected const PATH_PARAMS = array (
  'task_list_id' => 'task_list_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
