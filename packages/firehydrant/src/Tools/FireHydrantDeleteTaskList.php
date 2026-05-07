<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Delete a task list.
 *
 * Maps to the official FireHydrant endpoint delete /v1/task_lists/{task_list_id}.
 */
class FireHydrantDeleteTaskList extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_delete_task_list';
    protected const DESCRIPTION = 'Delete a task list

Official FireHydrant endpoint: DELETE /v1/task_lists/{task_list_id}

Delete a task list';
    protected const PARAMETERS = array (
  'task_list_id' =>
  array (
    'type' => 'string',
    'description' => 'task_list_id parameter.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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
