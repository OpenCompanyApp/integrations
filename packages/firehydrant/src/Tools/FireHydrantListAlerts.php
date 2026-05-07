<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List alerts.
 *
 * Maps to the official FireHydrant endpoint get /v1/alerts.
 */
class FireHydrantListAlerts extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_alerts';
    protected const DESCRIPTION = 'List alerts

Official FireHydrant endpoint: GET /v1/alerts

Retrieve all alerts, including Signals alerts and third-party';
    protected const PARAMETERS = array (
  'page' =>
  array (
    'type' => 'integer',
    'description' => 'page parameter.',
  ),
  'per_page' =>
  array (
    'type' => 'integer',
    'description' => 'per_page parameter.',
  ),
  'query' =>
  array (
    'type' => 'string',
    'description' => 'A text query for alerts',
  ),
  'users' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of user IDs. This currently only works for Signals alerts.',
  ),
  'teams' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of team IDs. This currently only works for Signals alerts.',
  ),
  'signal_rules' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of signals rule IDs. This currently only works for Signals alerts.',
  ),
  'environments' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of environment IDs. This currently only works for Signals alerts.',
  ),
  'functionalities' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of functionality IDs. This currently only works for Signals alerts.',
  ),
  'services' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of service IDs. This currently only works for Signals alerts.',
  ),
  'tags' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of tags. This currently only works for Signals alerts.',
  ),
  'tag_match_strategy' =>
  array (
    'type' => 'string',
    'description' => 'The strategy to match tags. `any` will return alerts that have at least one of the supplied tags, `match_all` will return only alerts that have all of the supplied tags, and `exclude` will only return alerts that have none of the supplied tags. This currently only works for Signals alerts.',
    'enum' =>
    array (
      0 => 'any',
      1 => 'match_all',
      2 => 'exclude',
    ),
  ),
  'statuses' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of statuses to filter by. Valid statuses are: opened, acknowledged, resolved, ignored, expired, linked, or snoozed',
  ),
  'start_date' =>
  array (
    'type' => 'string',
    'description' => 'Filters for alerts that started on or after the beginning of this date',
  ),
  'end_date' =>
  array (
    'type' => 'string',
    'description' => 'Filters for alerts that started on or before the end of this date',
  ),
  'start_datetime' =>
  array (
    'type' => 'string',
    'description' => 'Filters for alerts that started at or after this exact datetime',
  ),
  'end_datetime' =>
  array (
    'type' => 'string',
    'description' => 'Filters for alerts that started at or before this exact datetime',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/alerts';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'per_page' => 'per_page',
  'query' => 'query',
  'users' => 'users',
  'teams' => 'teams',
  'signal_rules' => 'signal_rules',
  'environments' => 'environments',
  'functionalities' => 'functionalities',
  'services' => 'services',
  'tags' => 'tags',
  'tag_match_strategy' => 'tag_match_strategy',
  'statuses' => 'statuses',
  'start_date' => 'start_date',
  'end_date' => 'end_date',
  'start_datetime' => 'start_datetime',
  'end_datetime' => 'end_datetime',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
