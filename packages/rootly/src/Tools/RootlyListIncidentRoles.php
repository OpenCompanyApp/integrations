<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List incident roles.
 *
 * Maps to the official Rootly endpoint get /v1/incident_roles.
 */
class RootlyListIncidentRoles extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incident_roles';
    protected const DESCRIPTION = 'List incident roles

Official Rootly endpoint: GET /v1/incident_roles

List incident roles';
    protected const PARAMETERS = array (
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
  'filter_slug' =>
  array (
    'type' => 'string',
    'description' => 'filter[slug] parameter.',
  ),
  'filter_name' =>
  array (
    'type' => 'string',
    'description' => 'filter[name] parameter.',
  ),
  'filter_enabled' =>
  array (
    'type' => 'boolean',
    'description' => 'filter[enabled] parameter.',
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
    protected const PATH = '/v1/incident_roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[search]' => 'filter_search',
  'filter[slug]' => 'filter_slug',
  'filter[name]' => 'filter_name',
  'filter[enabled]' => 'filter_enabled',
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
