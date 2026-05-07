<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List gzip configurations
 *
 * Maps to Fastly generated client operation GzipApi::listGzipConfigs (GET /service/{service_id}/version/{version_id}/gzip).
 */
class FastlyGzipListGzipConfigs extends AbstractFastlyTool
{
    protected const NAME = 'fastly_gzip_list_gzip_configs';
    protected const DESCRIPTION = 'List gzip configurations

Official Fastly client operation: GzipApi::listGzipConfigs
Endpoint: GET /service/{service_id}/version/{version_id}/gzip

List gzip configurations';
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
  'slug' => 'fastly_gzip_list_gzip_configs',
  'class' => 'FastlyGzipListGzipConfigs',
  'api_class' => 'GzipApi',
  'method_name' => 'listGzipConfigs',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/gzip',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List gzip configurations',
  'description' => 'List gzip configurations',
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
