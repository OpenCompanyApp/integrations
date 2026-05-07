<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Retrieve aggregated log results
 *
 * Maps to Fastly generated client operation ObservabilityAggregationsForLogsApi::logAggregationsGet (GET /observability/aggregations).
 */
class FastlyObservabilityAggregationsForLogsLogAggregationsGet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_observability_aggregations_for_logs_log_aggregations_get';
    protected const DESCRIPTION = 'Retrieve aggregated log results

Official Fastly client operation: ObservabilityAggregationsForLogsApi::logAggregationsGet
Endpoint: GET /observability/aggregations

Retrieve aggregated log results';
    protected const PARAMETERS = array (
  'source' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `source`.',
  ),
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `start`.',
  ),
  'end' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `end`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter`.',
  ),
  'series' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `series`.',
  ),
  'dimensions' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `dimensions`.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `sort`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_observability_aggregations_for_logs_log_aggregations_get',
  'class' => 'FastlyObservabilityAggregationsForLogsLogAggregationsGet',
  'api_class' => 'ObservabilityAggregationsForLogsApi',
  'method_name' => 'logAggregationsGet',
  'method' => 'GET',
  'path' => '/observability/aggregations',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Retrieve aggregated log results',
  'description' => 'Retrieve aggregated log results',
  'type' => 'read',
  'parameters' =>
  array (
    'source' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `source`.',
    ),
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'start' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `start`.',
    ),
    'end' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `end`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
    'filter' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter`.',
    ),
    'series' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `series`.',
    ),
    'dimensions' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `dimensions`.',
    ),
    'sort' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `sort`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'source' => 'source',
    'service_id' => 'service_id',
    'start' => 'start',
    'end' => 'end',
    'limit' => 'limit',
    'filter' => 'filter',
    'series' => 'series',
    'dimensions' => 'dimensions',
    'sort' => 'sort',
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
