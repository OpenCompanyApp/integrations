<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a gzip configuration
 *
 * Maps to Fastly generated client operation GzipApi::updateGzipConfig (PUT /service/{service_id}/version/{version_id}/gzip/{gzip_name}).
 */
class FastlyGzipUpdateGzipConfig extends AbstractFastlyTool
{
    protected const NAME = 'fastly_gzip_update_gzip_config';
    protected const DESCRIPTION = 'Update a gzip configuration

Official Fastly client operation: GzipApi::updateGzipConfig
Endpoint: PUT /service/{service_id}/version/{version_id}/gzip/{gzip_name}

Update a gzip configuration';
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
  'cache_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cache_condition`.',
  ),
  'content_types' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `content_types`.',
  ),
  'extensions' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `extensions`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_gzip_update_gzip_config',
  'class' => 'FastlyGzipUpdateGzipConfig',
  'api_class' => 'GzipApi',
  'method_name' => 'updateGzipConfig',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/gzip/{gzip_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a gzip configuration',
  'description' => 'Update a gzip configuration',
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
    'gzip_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `gzip_name`.',
    ),
    'cache_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cache_condition`.',
    ),
    'content_types' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `content_types`.',
    ),
    'extensions' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `extensions`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
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
    'cache_condition' => 'cache_condition',
    'content_types' => 'content_types',
    'extensions' => 'extensions',
    'name' => 'name',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
