<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Create a task list.
 *
 * Maps to the official FireHydrant endpoint post /v1/task_lists.
 */
class FireHydrantCreateTaskList extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_create_task_list';
    protected const DESCRIPTION = 'Create a task list

Official FireHydrant endpoint: POST /v1/task_lists

Creates a new task list';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the FireHydrant API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/task_lists';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
