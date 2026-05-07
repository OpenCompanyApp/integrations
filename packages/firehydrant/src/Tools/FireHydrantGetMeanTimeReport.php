<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get mean time metrics for incidents.
 *
 * Maps to the official FireHydrant endpoint get /v1/reports/mean_time.
 */
class FireHydrantGetMeanTimeReport extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_mean_time_report';
    protected const DESCRIPTION = 'Get mean time metrics for incidents

Official FireHydrant endpoint: GET /v1/reports/mean_time

Returns a report with time bucketed analytics data';
    protected const PARAMETERS = array (
  'environments' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of environment IDs',
  ),
  'teams' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of team IDs',
  ),
  'services' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of service IDs',
  ),
  'status' =>
  array (
    'type' => 'string',
    'description' => 'Incident status',
  ),
  'start_date' =>
  array (
    'type' => 'string',
    'description' => 'The start date to return incidents from',
  ),
  'end_date' =>
  array (
    'type' => 'string',
    'description' => 'The end date to return incidents from',
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A text query for an incident that searches on name, summary, and desciption',
  ),
  'saved_search_id' =>
  array (
    'type' => 'string',
    'description' => 'The id of a previously saved search.',
  ),
  'priorities' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of priorities',
  ),
  'priority_not_set' =>
  array (
    'type' => 'boolean',
    'description' => 'Flag for including incidents where priority has not been set',
  ),
  'severities' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of severities',
  ),
  'severity_not_set' =>
  array (
    'type' => 'boolean',
    'description' => 'Flag for including incidents where severity has not been set',
  ),
  'current_milestones' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of current milestones',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/reports/mean_time';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'environments' => 'environments',
  'teams' => 'teams',
  'services' => 'services',
  'status' => 'status',
  'start_date' => 'start_date',
  'end_date' => 'end_date',
  'query' => 'query',
  'saved_search_id' => 'saved_search_id',
  'priorities' => 'priorities',
  'priority_not_set' => 'priority_not_set',
  'severities' => 'severities',
  'severity_not_set' => 'severity_not_set',
  'current_milestones' => 'current_milestones',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
