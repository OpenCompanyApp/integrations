<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Enable support for HTTP/3
 *
 * Maps to Fastly generated client operation Http3Api::createHttp3 (POST /service/{service_id}/version/{version_id}/http3).
 */
class FastlyHttp3CreateHttp3 extends AbstractFastlyTool
{
    protected const NAME = 'fastly_http3_create_http3';
    protected const DESCRIPTION = 'Enable support for HTTP/3

Official Fastly client operation: Http3Api::createHttp3
Endpoint: POST /service/{service_id}/version/{version_id}/http3

Enable support for HTTP/3';
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
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `version`.',
  ),
  'created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `created_at`.',
  ),
  'deleted_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `deleted_at`.',
  ),
  'updated_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `updated_at`.',
  ),
  'feature_revision' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `feature_revision`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_http3_create_http3',
  'class' => 'FastlyHttp3CreateHttp3',
  'api_class' => 'Http3Api',
  'method_name' => 'createHttp3',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/http3',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Enable support for HTTP/3',
  'description' => 'Enable support for HTTP/3',
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
    'version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `version`.',
    ),
    'created_at' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `created_at`.',
    ),
    'deleted_at' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `deleted_at`.',
    ),
    'updated_at' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `updated_at`.',
    ),
    'feature_revision' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `feature_revision`.',
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
    'service_id' => 'service_id',
    'version' => 'version',
    'created_at' => 'created_at',
    'deleted_at' => 'deleted_at',
    'updated_at' => 'updated_at',
    'feature_revision' => 'feature_revision',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
