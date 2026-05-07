<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get stats for a service
 *
 * Maps to Fastly generated client operation StatsApi::getServiceStats (GET /service/{service_id}/stats/summary).
 */
class FastlyStatsGetServiceStats extends AbstractFastlyTool
{
    protected const NAME = 'fastly_stats_get_service_stats';
    protected const DESCRIPTION = 'Get stats for a service

Official Fastly client operation: StatsApi::getServiceStats
Endpoint: GET /service/{service_id}/stats/summary

Get stats for a service';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'month' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `month`.',
  ),
  'year' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `year`.',
  ),
  'start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `start_time`.',
  ),
  'end_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `end_time`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_stats_get_service_stats',
  'class' => 'FastlyStatsGetServiceStats',
  'api_class' => 'StatsApi',
  'method_name' => 'getServiceStats',
  'method' => 'GET',
  'path' => '/service/{service_id}/stats/summary',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get stats for a service',
  'description' => 'Get stats for a service',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'month' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `month`.',
    ),
    'year' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `year`.',
    ),
    'start_time' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `start_time`.',
    ),
    'end_time' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `end_time`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
  ),
  'query_params' =>
  array (
    'month' => 'month',
    'year' => 'year',
    'start_time' => 'start_time',
    'end_time' => 'end_time',
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
