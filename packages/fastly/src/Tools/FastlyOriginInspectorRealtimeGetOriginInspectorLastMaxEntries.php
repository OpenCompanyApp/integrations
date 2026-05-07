<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a limited number of real-time origin data entries
 *
 * Maps to Fastly generated client operation OriginInspectorRealtimeApi::getOriginInspectorLastMaxEntries (GET /v1/origins/{service_id}/ts/h/limit/{max_entries}).
 */
class FastlyOriginInspectorRealtimeGetOriginInspectorLastMaxEntries extends AbstractFastlyTool
{
    protected const NAME = 'fastly_origin_inspector_realtime_get_origin_inspector_last_max_entries';
    protected const DESCRIPTION = 'Get a limited number of real-time origin data entries

Official Fastly client operation: OriginInspectorRealtimeApi::getOriginInspectorLastMaxEntries
Endpoint: GET /v1/origins/{service_id}/ts/h/limit/{max_entries}

Get a limited number of real-time origin data entries';
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
  'slug' => 'fastly_origin_inspector_realtime_get_origin_inspector_last_max_entries',
  'class' => 'FastlyOriginInspectorRealtimeGetOriginInspectorLastMaxEntries',
  'api_class' => 'OriginInspectorRealtimeApi',
  'method_name' => 'getOriginInspectorLastMaxEntries',
  'method' => 'GET',
  'path' => '/v1/origins/{service_id}/ts/h/limit/{max_entries}',
  'hosts' =>
  array (
    0 => 'https://rt.fastly.com',
  ),
  'operation_host' => 'https://rt.fastly.com',
  'name' => 'Get a limited number of real-time origin data entries',
  'description' => 'Get a limited number of real-time origin data entries',
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
