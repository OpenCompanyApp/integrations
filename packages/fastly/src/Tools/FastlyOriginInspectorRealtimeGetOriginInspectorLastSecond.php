<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get real-time origin data from specific time.
 *
 * Maps to Fastly generated client operation OriginInspectorRealtimeApi::getOriginInspectorLastSecond (GET /v1/origins/{service_id}/ts/{start_timestamp}).
 */
class FastlyOriginInspectorRealtimeGetOriginInspectorLastSecond extends AbstractFastlyTool
{
    protected const NAME = 'fastly_origin_inspector_realtime_get_origin_inspector_last_second';
    protected const DESCRIPTION = 'Get real-time origin data from specific time.

Official Fastly client operation: OriginInspectorRealtimeApi::getOriginInspectorLastSecond
Endpoint: GET /v1/origins/{service_id}/ts/{start_timestamp}

Get real-time origin data from specific time.';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'start_timestamp' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `start_timestamp`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_origin_inspector_realtime_get_origin_inspector_last_second',
  'class' => 'FastlyOriginInspectorRealtimeGetOriginInspectorLastSecond',
  'api_class' => 'OriginInspectorRealtimeApi',
  'method_name' => 'getOriginInspectorLastSecond',
  'method' => 'GET',
  'path' => '/v1/origins/{service_id}/ts/{start_timestamp}',
  'hosts' =>
  array (
    0 => 'https://rt.fastly.com',
  ),
  'operation_host' => 'https://rt.fastly.com',
  'name' => 'Get real-time origin data from specific time.',
  'description' => 'Get real-time origin data from specific time.',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'start_timestamp' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `start_timestamp`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'start_timestamp' => 'start_timestamp',
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
