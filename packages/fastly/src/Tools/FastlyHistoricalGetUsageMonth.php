<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get month-to-date usage statistics
 *
 * Maps to Fastly generated client operation HistoricalApi::getUsageMonth (GET /stats/usage_by_month).
 */
class FastlyHistoricalGetUsageMonth extends AbstractFastlyTool
{
    protected const NAME = 'fastly_historical_get_usage_month';
    protected const DESCRIPTION = 'Get month-to-date usage statistics

Official Fastly client operation: HistoricalApi::getUsageMonth
Endpoint: GET /stats/usage_by_month

Get month-to-date usage statistics';
    protected const PARAMETERS = array (
  'year' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `year`.',
  ),
  'month' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `month`.',
  ),
  'billable_units' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `billable_units`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_historical_get_usage_month',
  'class' => 'FastlyHistoricalGetUsageMonth',
  'api_class' => 'HistoricalApi',
  'method_name' => 'getUsageMonth',
  'method' => 'GET',
  'path' => '/stats/usage_by_month',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get month-to-date usage statistics',
  'description' => 'Get month-to-date usage statistics',
  'type' => 'read',
  'parameters' =>
  array (
    'year' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `year`.',
    ),
    'month' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `month`.',
    ),
    'billable_units' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `billable_units`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'year' => 'year',
    'month' => 'month',
    'billable_units' => 'billable_units',
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
