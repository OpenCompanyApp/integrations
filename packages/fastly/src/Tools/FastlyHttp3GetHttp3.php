<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get HTTP/3 status
 *
 * Maps to Fastly generated client operation Http3Api::getHttp3 (GET /service/{service_id}/version/{version_id}/http3).
 */
class FastlyHttp3GetHttp3 extends AbstractFastlyTool
{
    protected const NAME = 'fastly_http3_get_http3';
    protected const DESCRIPTION = 'Get HTTP/3 status

Official Fastly client operation: Http3Api::getHttp3
Endpoint: GET /service/{service_id}/version/{version_id}/http3

Get HTTP/3 status';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `version_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_http3_get_http3',
  'class' => 'FastlyHttp3GetHttp3',
  'api_class' => 'Http3Api',
  'method_name' => 'getHttp3',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/http3',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get HTTP/3 status',
  'description' => 'Get HTTP/3 status',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'version_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `version_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
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
