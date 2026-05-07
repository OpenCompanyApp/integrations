<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List workflow groups.
 *
 * Maps to the official Rootly endpoint get /v1/workflow_groups.
 */
class RootlyListWorkflowGroups extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_workflow_groups';
    protected const DESCRIPTION = 'List workflow groups

Official Rootly endpoint: GET /v1/workflow_groups

List workflow groups';
    protected const PARAMETERS = array (
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
  'filter_kind' =>
  array (
    'type' => 'string',
    'description' => 'filter[kind] parameter.',
  ),
  'filter_expanded' =>
  array (
    'type' => 'boolean',
    'description' => 'filter[expanded] parameter.',
  ),
  'filter_position' =>
  array (
    'type' => 'integer',
    'description' => 'filter[position] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/workflow_groups';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[search]' => 'filter_search',
  'filter[name]' => 'filter_name',
  'filter[slug]' => 'filter_slug',
  'filter[kind]' => 'filter_kind',
  'filter[expanded]' => 'filter_expanded',
  'filter[position]' => 'filter_position',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
