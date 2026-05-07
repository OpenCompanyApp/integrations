<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get real-time data for the last 120 seconds
 *
 * Maps to Fastly generated client operation RealtimeApi::getStatsLast120Seconds (GET /v1/channel/{service_id}/ts/h).
 */
class FastlyRealtimeGetStatsLast120Seconds extends AbstractFastlyTool
{
    protected const NAME = 'fastly_realtime_get_stats_last120_seconds';
    protected const DESCRIPTION = 'Get real-time data for the last 120 seconds

Official Fastly client operation: RealtimeApi::getStatsLast120Seconds
Endpoint: GET /v1/channel/{service_id}/ts/h

Get real-time data for the last 120 seconds';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_realtime_get_stats_last120_seconds',
  'class' => 'FastlyRealtimeGetStatsLast120Seconds',
  'api_class' => 'RealtimeApi',
  'method_name' => 'getStatsLast120Seconds',
  'method' => 'GET',
  'path' => '/v1/channel/{service_id}/ts/h',
  'hosts' =>
  array (
    0 => 'https://rt.fastly.com',
  ),
  'operation_host' => 'https://rt.fastly.com',
  'name' => 'Get real-time data for the last 120 seconds',
  'description' => 'Get real-time data for the last 120 seconds',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
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
