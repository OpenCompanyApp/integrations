<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a limited number of real-time domain data entries
 *
 * Maps to Fastly generated client operation DomainInspectorRealtimeApi::getDomainInspectorLastMaxEntries (GET /v1/domains/{service_id}/ts/h/limit/{max_entries}).
 */
class FastlyDomainInspectorRealtimeGetDomainInspectorLastMaxEntries extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_inspector_realtime_get_domain_inspector_last_max_entries';
    protected const DESCRIPTION = 'Get a limited number of real-time domain data entries

Official Fastly client operation: DomainInspectorRealtimeApi::getDomainInspectorLastMaxEntries
Endpoint: GET /v1/domains/{service_id}/ts/h/limit/{max_entries}

Get a limited number of real-time domain data entries';
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
  'slug' => 'fastly_domain_inspector_realtime_get_domain_inspector_last_max_entries',
  'class' => 'FastlyDomainInspectorRealtimeGetDomainInspectorLastMaxEntries',
  'api_class' => 'DomainInspectorRealtimeApi',
  'method_name' => 'getDomainInspectorLastMaxEntries',
  'method' => 'GET',
  'path' => '/v1/domains/{service_id}/ts/h/limit/{max_entries}',
  'hosts' =>
  array (
    0 => 'https://rt.fastly.com',
  ),
  'operation_host' => 'https://rt.fastly.com',
  'name' => 'Get a limited number of real-time domain data entries',
  'description' => 'Get a limited number of real-time domain data entries',
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
