<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a gzip configuration
 *
 * Maps to Fastly generated client operation GzipApi::getGzipConfigs (GET /service/{service_id}/version/{version_id}/gzip/{gzip_name}).
 */
class FastlyGzipGetGzipConfigs extends AbstractFastlyTool
{
    protected const NAME = 'fastly_gzip_get_gzip_configs';
    protected const DESCRIPTION = 'Get a gzip configuration

Official Fastly client operation: GzipApi::getGzipConfigs
Endpoint: GET /service/{service_id}/version/{version_id}/gzip/{gzip_name}

Get a gzip configuration';
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
  'gzip_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `gzip_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_gzip_get_gzip_configs',
  'class' => 'FastlyGzipGetGzipConfigs',
  'api_class' => 'GzipApi',
  'method_name' => 'getGzipConfigs',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/gzip/{gzip_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a gzip configuration',
  'description' => 'Get a gzip configuration',
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
    'gzip_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `gzip_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'gzip_name' => 'gzip_name',
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
