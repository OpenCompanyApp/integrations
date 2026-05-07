<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List workflow tasks.
 *
 * Maps to the official Rootly endpoint get /v1/workflows/{workflow_id}/workflow_tasks.
 */
class RootlyListWorkflowTasks extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_workflow_tasks';
    protected const DESCRIPTION = 'List workflow tasks

Official Rootly endpoint: GET /v1/workflows/{workflow_id}/workflow_tasks

List workflow tasks';
    protected const PARAMETERS = array (
  'workflow_id' =>
  array (
    'type' => 'string',
    'description' => 'workflow_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'include parameter.',
  ),
  'page_number' =>
  array (
    'type' => 'integer',
    'description' => 'page[number] parameter.',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'description' => 'page[size] parameter.',
  ),
  'filter_search' =>
  array (
    'type' => 'string',
    'description' => 'filter[search] parameter.',
  ),
  'filter_name' =>
  array (
    'type' => 'string',
    'description' => 'filter[name] parameter.',
  ),
  'filter_slug' =>
  array (
    'type' => 'string',
    'description' => 'filter[slug] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/workflows/{workflow_id}/workflow_tasks';
    protected const PATH_PARAMS = array (
  'workflow_id' => 'workflow_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[search]' => 'filter_search',
  'filter[name]' => 'filter_name',
  'filter[slug]' => 'filter_slug',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
