<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List all action items for an organization.
 *
 * Maps to the official Rootly endpoint get /v1/action_items.
 */
class RootlyListAllIncidentActionItems extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_all_incident_action_items';
    protected const DESCRIPTION = 'List all action items for an organization

Official Rootly endpoint: GET /v1/action_items

List all action items for an organization';
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
  'filter_kind' =>
  array (
    'type' => 'string',
    'description' => 'filter[kind] parameter.',
  ),
  'filter_priority' =>
  array (
    'type' => 'string',
    'description' => 'filter[priority] parameter.',
  ),
  'filter_status' =>
  array (
    'type' => 'string',
    'description' => 'filter[status] parameter.',
  ),
  'filter_incident_status' =>
  array (
    'type' => 'string',
    'description' => 'filter[incident_status] parameter.',
  ),
  'filter_incident_created_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[incident_created_at][gt] parameter.',
  ),
  'filter_incident_created_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[incident_created_at][gte] parameter.',
  ),
  'filter_incident_created_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[incident_created_at][lt] parameter.',
  ),
  'filter_incident_created_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[incident_created_at][lte] parameter.',
  ),
  'filter_due_date_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[due_date][gt] parameter.',
  ),
  'filter_due_date_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[due_date][gte] parameter.',
  ),
  'filter_due_date_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[due_date][lt] parameter.',
  ),
  'filter_due_date_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[due_date][lte] parameter.',
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
    protected const PATH = '/v1/action_items';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[kind]' => 'filter_kind',
  'filter[priority]' => 'filter_priority',
  'filter[status]' => 'filter_status',
  'filter[incident_status]' => 'filter_incident_status',
  'filter[incident_created_at][gt]' => 'filter_incident_created_at_gt',
  'filter[incident_created_at][gte]' => 'filter_incident_created_at_gte',
  'filter[incident_created_at][lt]' => 'filter_incident_created_at_lt',
  'filter[incident_created_at][lte]' => 'filter_incident_created_at_lte',
  'filter[due_date][gt]' => 'filter_due_date_gt',
  'filter[due_date][gte]' => 'filter_due_date_gte',
  'filter[due_date][lt]' => 'filter_due_date_lt',
  'filter[due_date][lte]' => 'filter_due_date_lte',
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
