<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a gzip configuration
 *
 * Maps to Fastly generated client operation GzipApi::deleteGzipConfig (DELETE /service/{service_id}/version/{version_id}/gzip/{gzip_name}).
 */
class FastlyGzipDeleteGzipConfig extends AbstractFastlyTool
{
    protected const NAME = 'fastly_gzip_delete_gzip_config';
    protected const DESCRIPTION = 'Delete a gzip configuration

Official Fastly client operation: GzipApi::deleteGzipConfig
Endpoint: DELETE /service/{service_id}/version/{version_id}/gzip/{gzip_name}

Delete a gzip configuration';
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
  'slug' => 'fastly_gzip_delete_gzip_config',
  'class' => 'FastlyGzipDeleteGzipConfig',
  'api_class' => 'GzipApi',
  'method_name' => 'deleteGzipConfig',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/gzip/{gzip_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a gzip configuration',
  'description' => 'Delete a gzip configuration',
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
