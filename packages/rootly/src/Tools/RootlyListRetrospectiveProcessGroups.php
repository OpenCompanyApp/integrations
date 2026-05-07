<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List Retrospective Process Groups.
 *
 * Maps to the official Rootly endpoint get /v1/retrospective_processes/{retrospective_process_id}/groups.
 */
class RootlyListRetrospectiveProcessGroups extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_retrospective_process_groups';
    protected const DESCRIPTION = 'List Retrospective Process Groups

Official Rootly endpoint: GET /v1/retrospective_processes/{retrospective_process_id}/groups

List Retrospective Process Groups';
    protected const PARAMETERS = array (
  'retrospective_process_id' =>
  array (
    'type' => 'string',
    'description' => 'retrospective_process_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: retrospective_process_group_steps',
    'enum' =>
    array (
      0 => 'retrospective_process_group_steps',
    ),
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: created_at,updated_at',
    'enum' =>
    array (
      0 => 'created_at',
      1 => '-created_at',
      2 => 'updated_at',
      3 => '-updated_at',
      4 => 'position',
      5 => '-position',
    ),
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
  'filter_sub_status_id' =>
  array (
    'type' => 'string',
    'description' => 'filter[sub_status_id] parameter.',
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
    protected const PATH = '/v1/retrospective_processes/{retrospective_process_id}/groups';
    protected const PATH_PARAMS = array (
  'retrospective_process_id' => 'retrospective_process_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'sort' => 'sort',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[sub_status_id]' => 'filter_sub_status_id',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
