<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Disable support for HTTP/3
 *
 * Maps to Fastly generated client operation Http3Api::deleteHttp3 (DELETE /service/{service_id}/version/{version_id}/http3).
 */
class FastlyHttp3DeleteHttp3 extends AbstractFastlyTool
{
    protected const NAME = 'fastly_http3_delete_http3';
    protected const DESCRIPTION = 'Disable support for HTTP/3

Official Fastly client operation: Http3Api::deleteHttp3
Endpoint: DELETE /service/{service_id}/version/{version_id}/http3

Disable support for HTTP/3';
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
  'slug' => 'fastly_http3_delete_http3',
  'class' => 'FastlyHttp3DeleteHttp3',
  'api_class' => 'Http3Api',
  'method_name' => 'deleteHttp3',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/http3',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Disable support for HTTP/3',
  'description' => 'Disable support for HTTP/3',
  'type' => 'write',
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
