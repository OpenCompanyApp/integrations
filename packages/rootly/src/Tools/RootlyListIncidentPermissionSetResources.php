<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List incident_permission_set_resources.
 *
 * Maps to the official Rootly endpoint get /v1/incident_permission_sets/{incident_permission_set_id}/resources.
 */
class RootlyListIncidentPermissionSetResources extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incident_permission_set_resources';
    protected const DESCRIPTION = 'List incident_permission_set_resources

Official Rootly endpoint: GET /v1/incident_permission_sets/{incident_permission_set_id}/resources

List incident_permission_set_resources';
    protected const PARAMETERS = array (
  'incident_permission_set_id' =>
  array (
    'type' => 'string',
    'description' => 'incident_permission_set_id parameter.',
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
  'filter_kind' =>
  array (
    'type' => 'string',
    'description' => 'filter[kind] parameter.',
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
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'sort parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/incident_permission_sets/{incident_permission_set_id}/resources';
    protected const PATH_PARAMS = array (
  'incident_permission_set_id' => 'incident_permission_set_id',
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[kind]' => 'filter_kind',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
