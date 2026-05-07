<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a limited number of real-time data entries
 *
 * Maps to Fastly generated client operation RealtimeApi::getStatsLast120SecondsLimitEntries (GET /v1/channel/{service_id}/ts/h/limit/{max_entries}).
 */
class FastlyRealtimeGetStatsLast120SecondsLimitEntries extends AbstractFastlyTool
{
    protected const NAME = 'fastly_realtime_get_stats_last120_seconds_limit_entries';
    protected const DESCRIPTION = 'Get a limited number of real-time data entries

Official Fastly client operation: RealtimeApi::getStatsLast120SecondsLimitEntries
Endpoint: GET /v1/channel/{service_id}/ts/h/limit/{max_entries}

Get a limited number of real-time data entries';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'max_entries' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `max_entries`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_realtime_get_stats_last120_seconds_limit_entries',
  'class' => 'FastlyRealtimeGetStatsLast120SecondsLimitEntries',
  'api_class' => 'RealtimeApi',
  'method_name' => 'getStatsLast120SecondsLimitEntries',
  'method' => 'GET',
  'path' => '/v1/channel/{service_id}/ts/h/limit/{max_entries}',
  'hosts' =>
  array (
    0 => 'https://rt.fastly.com',
  ),
  'operation_host' => 'https://rt.fastly.com',
  'name' => 'Get a limited number of real-time data entries',
  'description' => 'Get a limited number of real-time data entries',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'max_entries' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `max_entries`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'max_entries' => 'max_entries',
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
