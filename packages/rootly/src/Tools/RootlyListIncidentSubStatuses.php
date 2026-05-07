<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List incident_sub_statuses.
 *
 * Maps to the official Rootly endpoint get /v1/incidents/{incident_id}/sub_statuses.
 */
class RootlyListIncidentSubStatuses extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incident_sub_statuses';
    protected const DESCRIPTION = 'List incident_sub_statuses

Official Rootly endpoint: GET /v1/incidents/{incident_id}/sub_statuses

List incident_sub_statuses';
    protected const PARAMETERS = array (
  'incident_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_id parameter.',
    'required' => true,
  ),
  'include' =>
  array (
    'type' => 'string',
    'description' => 'comma separated if needed. eg: sub_status,assigned_by_user',
    'enum' =>
    array (
      0 => 'sub_status',
      1 => 'assigned_by_user',
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
      4 => 'assigned_at',
      5 => '-assigned_at',
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
  'filter_assigned_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[assigned_at][gt] parameter.',
  ),
  'filter_assigned_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[assigned_at][gte] parameter.',
  ),
  'filter_assigned_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[assigned_at][lt] parameter.',
  ),
  'filter_assigned_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[assigned_at][lte] parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incidents/{incident_id}/sub_statuses';
    protected const PATH_PARAMS = array (
  'incident_id' => 'incident_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'sort' => 'sort',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[sub_status_id]' => 'filter_sub_status_id',
  'filter[assigned_at][gt]' => 'filter_assigned_at_gt',
  'filter[assigned_at][gte]' => 'filter_assigned_at_gte',
  'filter[assigned_at][lt]' => 'filter_assigned_at_lt',
  'filter[assigned_at][lte]' => 'filter_assigned_at_lte',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
