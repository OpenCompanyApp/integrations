<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get real-time domain data for the last 120 seconds
 *
 * Maps to Fastly generated client operation DomainInspectorRealtimeApi::getDomainInspectorLast120Seconds (GET /v1/domains/{service_id}/ts/h).
 */
class FastlyDomainInspectorRealtimeGetDomainInspectorLast120Seconds extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_inspector_realtime_get_domain_inspector_last120_seconds';
    protected const DESCRIPTION = 'Get real-time domain data for the last 120 seconds

Official Fastly client operation: DomainInspectorRealtimeApi::getDomainInspectorLast120Seconds
Endpoint: GET /v1/domains/{service_id}/ts/h

Get real-time domain data for the last 120 seconds';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_domain_inspector_realtime_get_domain_inspector_last120_seconds',
  'class' => 'FastlyDomainInspectorRealtimeGetDomainInspectorLast120Seconds',
  'api_class' => 'DomainInspectorRealtimeApi',
  'method_name' => 'getDomainInspectorLast120Seconds',
  'method' => 'GET',
  'path' => '/v1/domains/{service_id}/ts/h',
  'hosts' =>
  array (
    0 => 'https://rt.fastly.com',
  ),
  'operation_host' => 'https://rt.fastly.com',
  'name' => 'Get real-time domain data for the last 120 seconds',
  'description' => 'Get real-time domain data for the last 120 seconds',
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
