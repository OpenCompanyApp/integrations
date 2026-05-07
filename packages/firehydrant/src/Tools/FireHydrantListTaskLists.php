<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List task lists.
 *
 * Maps to the official FireHydrant endpoint get /v1/task_lists.
 */
class FireHydrantListTaskLists extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_task_lists';
    protected const DESCRIPTION = 'List task lists

Official FireHydrant endpoint: GET /v1/task_lists

Lists all task lists for your organization';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/task_lists';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
