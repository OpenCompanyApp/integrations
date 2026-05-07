<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get real-time origin data for the last 120 seconds
 *
 * Maps to Fastly generated client operation OriginInspectorRealtimeApi::getOriginInspectorLast120Seconds (GET /v1/origins/{service_id}/ts/h).
 */
class FastlyOriginInspectorRealtimeGetOriginInspectorLast120Seconds extends AbstractFastlyTool
{
    protected const NAME = 'fastly_origin_inspector_realtime_get_origin_inspector_last120_seconds';
    protected const DESCRIPTION = 'Get real-time origin data for the last 120 seconds

Official Fastly client operation: OriginInspectorRealtimeApi::getOriginInspectorLast120Seconds
Endpoint: GET /v1/origins/{service_id}/ts/h

Get real-time origin data for the last 120 seconds';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_origin_inspector_realtime_get_origin_inspector_last120_seconds',
  'class' => 'FastlyOriginInspectorRealtimeGetOriginInspectorLast120Seconds',
  'api_class' => 'OriginInspectorRealtimeApi',
  'method_name' => 'getOriginInspectorLast120Seconds',
  'method' => 'GET',
  'path' => '/v1/origins/{service_id}/ts/h',
  'hosts' =>
  array (
    0 => 'https://rt.fastly.com',
  ),
  'operation_host' => 'https://rt.fastly.com',
  'name' => 'Get real-time origin data for the last 120 seconds',
  'description' => 'Get real-time origin data for the last 120 seconds',
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
