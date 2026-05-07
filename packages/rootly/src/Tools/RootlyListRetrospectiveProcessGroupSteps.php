<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List RetrospectiveProcessGroup Steps.
 *
 * Maps to the official Rootly endpoint get /v1/retrospective_process_groups/{retrospective_process_group_id}/steps.
 */
class RootlyListRetrospectiveProcessGroupSteps extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_retrospective_process_group_steps';
    protected const DESCRIPTION = 'List RetrospectiveProcessGroup Steps

Official Rootly endpoint: GET /v1/retrospective_process_groups/{retrospective_process_group_id}/steps

List RetrospectiveProcessGroup Steps';
    protected const PARAMETERS = array (
  'retrospective_process_group_id' =>
  array (
    'type' => 'string',
    'description' => 'retrospective_process_group_id parameter.',
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
  'filter_retrospective_step_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[retrospective_step_id] parameter.',
  ),
  'filter_created_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][gt] parameter.',
  ),
  'filter_created_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][gte] parameter.',
  ),
  'filter_created_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][lt] parameter.',
  ),
  'filter_created_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[created_at][lte] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/retrospective_process_groups/{retrospective_process_group_id}/steps';
    protected const PATH_PARAMS = array (
  'retrospective_process_group_id' => 'retrospective_process_group_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[retrospective_step_id]' => 'filter_retrospective_step_id',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
