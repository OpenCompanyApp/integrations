<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Get MTTX analytics for signals.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/analytics/mttx.
 */
class FireHydrantGetSignalsMttxAnalytics extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_get_signals_mttx_analytics';
    protected const DESCRIPTION = 'Get MTTX analytics for signals

Official FireHydrant endpoint: GET /v1/signals/analytics/mttx

Get mean-time-to-acknowledged (MTTA) and mean-time-to-resolved (MTTR) metrics for Signals alerts';
    protected const PARAMETERS = array (
  'signal_rules' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of signal rule IDs',
  ),
  'teams' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of team IDs',
  ),
  'environments' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of environment IDs',
  ),
  'services' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of service IDs',
  ),
  'tags' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of tags',
  ),
  'users' =>
  array (
    'type' => 'string',
    'description' => 'A comma separated list of user IDs',
  ),
  'group_by' =>
  array (
    'type' => 'string',
    'description' => 'String that determines how records are grouped',
    'enum' =>
    array (
      0 => 'signal_rules',
      1 => 'teams',
      2 => 'services',
      3 => 'environments',
      4 => 'tags',
    ),
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'description' => 'String that determines how records are sorted',
    'enum' =>
    array (
      0 => 'total_opened_alerts',
      1 => 'total_acked_alerts',
      2 => 'total_incidents',
      3 => 'total_billable_alerts',
      4 => 'acked_percentage',
      5 => 'incidents_percentage',
    ),
  ),
  'sort_direction' =>
  array (
    'type' => 'string',
    'description' => 'String that determines how records are sorted',
    'enum' =>
    array (
      0 => 'asc',
      1 => 'desc',
    ),
  ),
  'start_date' =>
  array (
    'type' => 'string',
    'description' => 'The start date to return metrics from',
  ),
  'end_date' =>
  array (
    'type' => 'string',
    'description' => 'The end date to return metrics from',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/analytics/mttx';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'signal_rules' => 'signal_rules',
  'teams' => 'teams',
  'environments' => 'environments',
  'services' => 'services',
  'tags' => 'tags',
  'users' => 'users',
  'group_by' => 'group_by',
  'sort_by' => 'sort_by',
  'sort_direction' => 'sort_direction',
  'start_date' => 'start_date',
  'end_date' => 'end_date',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
