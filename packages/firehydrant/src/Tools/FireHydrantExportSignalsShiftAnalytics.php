<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * Export on-call hours report.
 *
 * Maps to the official FireHydrant endpoint get /v1/signals/analytics/shifts/export.
 */
class FireHydrantExportSignalsShiftAnalytics extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_export_signals_shift_analytics';
    protected const DESCRIPTION = 'Export on-call hours report

Official FireHydrant endpoint: GET /v1/signals/analytics/shifts/export

Export on-call hours report for users/teams during a time period';
    protected const PARAMETERS = array (
  'user_ids' =>
  array (
    'type' => 'array',
    'description' => 'Array of user IDs to fetch oncall hours for',
  ),
  'team_ids' =>
  array (
    'type' => 'array',
    'description' => 'Array of team IDs to fetch oncall hours for',
  ),
  'period_start' =>
  array (
    'type' => 'string',
    'description' => 'Start of the period to fetch hours for (UTC)',
    'required' => true,
  ),
  'period_end' =>
  array (
    'type' => 'string',
    'description' => 'End of the period to fetch hours for (UTC)',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/signals/analytics/shifts/export';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'user_ids' => 'user_ids',
  'team_ids' => 'team_ids',
  'period_start' => 'period_start',
  'period_end' => 'period_end',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
