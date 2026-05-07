<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get real-time domain data from a specified time
 *
 * Maps to Fastly generated client operation DomainInspectorRealtimeApi::getDomainInspectorLastSecond (GET /v1/domains/{service_id}/ts/{start_timestamp}).
 */
class FastlyDomainInspectorRealtimeGetDomainInspectorLastSecond extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_inspector_realtime_get_domain_inspector_last_second';
    protected const DESCRIPTION = 'Get real-time domain data from a specified time

Official Fastly client operation: DomainInspectorRealtimeApi::getDomainInspectorLastSecond
Endpoint: GET /v1/domains/{service_id}/ts/{start_timestamp}

Get real-time domain data from a specified time';
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
  'slug' => 'fastly_domain_inspector_realtime_get_domain_inspector_last_second',
  'class' => 'FastlyDomainInspectorRealtimeGetDomainInspectorLastSecond',
  'api_class' => 'DomainInspectorRealtimeApi',
  'method_name' => 'getDomainInspectorLastSecond',
  'method' => 'GET',
  'path' => '/v1/domains/{service_id}/ts/{start_timestamp}',
  'hosts' =>
  array (
    0 => 'https://rt.fastly.com',
  ),
  'operation_host' => 'https://rt.fastly.com',
  'name' => 'Get real-time domain data from a specified time',
  'description' => 'Get real-time domain data from a specified time',
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
