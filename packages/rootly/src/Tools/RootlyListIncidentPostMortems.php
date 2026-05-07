<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * List incident retrospectives.
 *
 * Maps to the official Rootly endpoint get /v1/post_mortems.
 */
class RootlyListIncidentPostMortems extends AbstractRootlyTool
{
    protected const NAME = 'rootly_list_incident_post_mortems';
    protected const DESCRIPTION = 'List incident retrospectives

Official Rootly endpoint: GET /v1/post_mortems

List incident retrospectives';
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
  'filter_status' =>
  array (
    'type' => 'string',
    'description' => 'filter[status] parameter.',
  ),
  'filter_severity' =>
  array (
    'type' => 'string',
    'description' => 'filter[severity] parameter.',
  ),
  'filter_type' =>
  array (
    'type' => 'string',
    'description' => 'filter[type] parameter.',
  ),
  'filter_user_id' =>
  array (
    'type' => 'integer',
    'description' => 'filter[user_id] parameter.',
  ),
  'filter_types' =>
  array (
    'type' => 'string',
    'description' => 'Filter by incident type slugs',
  ),
  'filter_type_ids' =>
  array (
    'type' => 'string',
    'description' => 'Filter by incident type IDs (UUIDs)',
  ),
  'filter_environments' =>
  array (
    'type' => 'string',
    'description' => 'Filter by environment slugs',
  ),
  'filter_environment_ids' =>
  array (
    'type' => 'string',
    'description' => 'Filter by environment IDs (UUIDs)',
  ),
  'filter_functionalities' =>
  array (
    'type' => 'string',
    'description' => 'Filter by functionality slugs',
  ),
  'filter_functionality_ids' =>
  array (
    'type' => 'string',
    'description' => 'Filter by functionality IDs (UUIDs)',
  ),
  'filter_services' =>
  array (
    'type' => 'string',
    'description' => 'Filter by service slugs',
  ),
  'filter_service_ids' =>
  array (
    'type' => 'string',
    'description' => 'Filter by service IDs (UUIDs)',
  ),
  'filter_teams' =>
  array (
    'type' => 'string',
    'description' => 'Filter by team/group slugs',
  ),
  'filter_team_ids' =>
  array (
    'type' => 'string',
    'description' => 'Filter by team/group IDs (UUIDs)',
  ),
  'filter_causes' =>
  array (
    'type' => 'string',
    'description' => 'Filter by cause slugs',
  ),
  'filter_cause_ids' =>
  array (
    'type' => 'string',
    'description' => 'Filter by cause IDs (UUIDs)',
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
  'filter_started_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][gt] parameter.',
  ),
  'filter_started_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][gte] parameter.',
  ),
  'filter_started_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][lt] parameter.',
  ),
  'filter_started_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[started_at][lte] parameter.',
  ),
  'filter_mitigated_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[mitigated_at][gt] parameter.',
  ),
  'filter_mitigated_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[mitigated_at][gte] parameter.',
  ),
  'filter_mitigated_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[mitigated_at][lt] parameter.',
  ),
  'filter_mitigated_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[mitigated_at][lte] parameter.',
  ),
  'filter_resolved_at_gt' =>
  array (
    'type' => 'string',
    'description' => 'filter[resolved_at][gt] parameter.',
  ),
  'filter_resolved_at_gte' =>
  array (
    'type' => 'string',
    'description' => 'filter[resolved_at][gte] parameter.',
  ),
  'filter_resolved_at_lt' =>
  array (
    'type' => 'string',
    'description' => 'filter[resolved_at][lt] parameter.',
  ),
  'filter_resolved_at_lte' =>
  array (
    'type' => 'string',
    'description' => 'filter[resolved_at][lte] parameter.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'description' => 'sort parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/post_mortems';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'include' => 'include',
  'page[number]' => 'page_number',
  'page[size]' => 'page_size',
  'filter[search]' => 'filter_search',
  'filter[status]' => 'filter_status',
  'filter[severity]' => 'filter_severity',
  'filter[type]' => 'filter_type',
  'filter[user_id]' => 'filter_user_id',
  'filter[types]' => 'filter_types',
  'filter[type_ids]' => 'filter_type_ids',
  'filter[environments]' => 'filter_environments',
  'filter[environment_ids]' => 'filter_environment_ids',
  'filter[functionalities]' => 'filter_functionalities',
  'filter[functionality_ids]' => 'filter_functionality_ids',
  'filter[services]' => 'filter_services',
  'filter[service_ids]' => 'filter_service_ids',
  'filter[teams]' => 'filter_teams',
  'filter[team_ids]' => 'filter_team_ids',
  'filter[causes]' => 'filter_causes',
  'filter[cause_ids]' => 'filter_cause_ids',
  'filter[created_at][gt]' => 'filter_created_at_gt',
  'filter[created_at][gte]' => 'filter_created_at_gte',
  'filter[created_at][lt]' => 'filter_created_at_lt',
  'filter[created_at][lte]' => 'filter_created_at_lte',
  'filter[started_at][gt]' => 'filter_started_at_gt',
  'filter[started_at][gte]' => 'filter_started_at_gte',
  'filter[started_at][lt]' => 'filter_started_at_lt',
  'filter[started_at][lte]' => 'filter_started_at_lte',
  'filter[mitigated_at][gt]' => 'filter_mitigated_at_gt',
  'filter[mitigated_at][gte]' => 'filter_mitigated_at_gte',
  'filter[mitigated_at][lt]' => 'filter_mitigated_at_lt',
  'filter[mitigated_at][lte]' => 'filter_mitigated_at_lte',
  'filter[resolved_at][gt]' => 'filter_resolved_at_gt',
  'filter[resolved_at][gte]' => 'filter_resolved_at_gte',
  'filter[resolved_at][lt]' => 'filter_resolved_at_lt',
  'filter[resolved_at][lte]' => 'filter_resolved_at_lte',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
