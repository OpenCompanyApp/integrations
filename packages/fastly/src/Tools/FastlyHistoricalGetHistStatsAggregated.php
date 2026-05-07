<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get aggregated historical stats
 *
 * Maps to Fastly generated client operation HistoricalApi::getHistStatsAggregated (GET /stats/aggregate).
 */
class FastlyHistoricalGetHistStatsAggregated extends AbstractFastlyTool
{
    protected const NAME = 'fastly_historical_get_hist_stats_aggregated';
    protected const DESCRIPTION = 'Get aggregated historical stats

Official Fastly client operation: HistoricalApi::getHistStatsAggregated
Endpoint: GET /stats/aggregate

Get aggregated historical stats';
    protected const PARAMETERS = array (
  'from' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `from`.',
  ),
  'to' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `to`.',
  ),
  'by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `by`.',
  ),
  'region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `region`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_historical_get_hist_stats_aggregated',
  'class' => 'FastlyHistoricalGetHistStatsAggregated',
  'api_class' => 'HistoricalApi',
  'method_name' => 'getHistStatsAggregated',
  'method' => 'GET',
  'path' => '/stats/aggregate',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get aggregated historical stats',
  'description' => 'Get aggregated historical stats',
  'type' => 'read',
  'parameters' =>
  array (
    'from' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `from`.',
    ),
    'to' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `to`.',
    ),
    'by' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `by`.',
    ),
    'region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `region`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'from' => 'from',
    'to' => 'to',
    'by' => 'by',
    'region' => 'region',
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
