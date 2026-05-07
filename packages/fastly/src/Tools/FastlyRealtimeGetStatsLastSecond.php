<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get real-time data from specified time
 *
 * Maps to Fastly generated client operation RealtimeApi::getStatsLastSecond (GET /v1/channel/{service_id}/ts/{timestamp_in_seconds}).
 */
class FastlyRealtimeGetStatsLastSecond extends AbstractFastlyTool
{
    protected const NAME = 'fastly_realtime_get_stats_last_second';
    protected const DESCRIPTION = 'Get real-time data from specified time

Official Fastly client operation: RealtimeApi::getStatsLastSecond
Endpoint: GET /v1/channel/{service_id}/ts/{timestamp_in_seconds}

Get real-time data from specified time';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'timestamp_in_seconds' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `timestamp_in_seconds`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_realtime_get_stats_last_second',
  'class' => 'FastlyRealtimeGetStatsLastSecond',
  'api_class' => 'RealtimeApi',
  'method_name' => 'getStatsLastSecond',
  'method' => 'GET',
  'path' => '/v1/channel/{service_id}/ts/{timestamp_in_seconds}',
  'hosts' =>
  array (
    0 => 'https://rt.fastly.com',
  ),
  'operation_host' => 'https://rt.fastly.com',
  'name' => 'Get real-time data from specified time',
  'description' => 'Get real-time data from specified time',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'timestamp_in_seconds' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `timestamp_in_seconds`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'timestamp_in_seconds' => 'timestamp_in_seconds',
  ),
  'query_params' =>
  array (
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
