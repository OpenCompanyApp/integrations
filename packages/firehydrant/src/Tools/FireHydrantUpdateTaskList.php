<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Update a task list.
 *
 * Maps to the official FireHydrant endpoint patch /v1/task_lists/{task_list_id}.
 */
class FireHydrantUpdateTaskList extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_update_task_list';
    protected const DESCRIPTION = 'Update a task list

Official FireHydrant endpoint: PATCH /v1/task_lists/{task_list_id}

Updates a task list\'s attributes and task list items';
    protected const PARAMETERS = array (
  'task_list_id' =>
  array (
    'type' => 'string',
    'description' => 'task_list_id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/task_lists/{task_list_id}';
    protected const PATH_PARAMS = array (
  'task_list_id' => 'task_list_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
