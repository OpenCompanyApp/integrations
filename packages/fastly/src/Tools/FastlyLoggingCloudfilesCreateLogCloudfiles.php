<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a Cloud Files log endpoint
 *
 * Maps to Fastly generated client operation LoggingCloudfilesApi::createLogCloudfiles (POST /service/{service_id}/version/{version_id}/logging/cloudfiles).
 */
class FastlyLoggingCloudfilesCreateLogCloudfiles extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_cloudfiles_create_log_cloudfiles';
    protected const DESCRIPTION = 'Create a Cloud Files log endpoint

Official Fastly client operation: LoggingCloudfilesApi::createLogCloudfiles
Endpoint: POST /service/{service_id}/version/{version_id}/logging/cloudfiles

Create a Cloud Files log endpoint';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'placement' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `placement`.',
  ),
  'response_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `response_condition`.',
  ),
  'format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format`.',
  ),
  'log_processing_region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `log_processing_region`.',
  ),
  'format_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format_version`.',
  ),
  'message_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `message_type`.',
  ),
  'timestamp_format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `timestamp_format`.',
  ),
  'compression_codec' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `compression_codec`.',
  ),
  'period' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `period`.',
  ),
  'gzip_level' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `gzip_level`.',
  ),
  'access_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `access_key`.',
  ),
  'bucket_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `bucket_name`.',
  ),
  'path' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `path`.',
  ),
  'region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `region`.',
  ),
  'public_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `public_key`.',
  ),
  'user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `user`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_cloudfiles_create_log_cloudfiles',
  'class' => 'FastlyLoggingCloudfilesCreateLogCloudfiles',
  'api_class' => 'LoggingCloudfilesApi',
  'method_name' => 'createLogCloudfiles',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/logging/cloudfiles',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a Cloud Files log endpoint',
  'description' => 'Create a Cloud Files log endpoint',
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
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'placement' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `placement`.',
    ),
    'response_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `response_condition`.',
    ),
    'format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format`.',
    ),
    'log_processing_region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `log_processing_region`.',
    ),
    'format_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format_version`.',
    ),
    'message_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `message_type`.',
    ),
    'timestamp_format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `timestamp_format`.',
    ),
    'compression_codec' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `compression_codec`.',
    ),
    'period' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `period`.',
    ),
    'gzip_level' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `gzip_level`.',
    ),
    'access_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `access_key`.',
    ),
    'bucket_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `bucket_name`.',
    ),
    'path' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `path`.',
    ),
    'region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `region`.',
    ),
    'public_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `public_key`.',
    ),
    'user' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `user`.',
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
    'name' => 'name',
    'placement' => 'placement',
    'response_condition' => 'response_condition',
    'format' => 'format',
    'log_processing_region' => 'log_processing_region',
    'format_version' => 'format_version',
    'message_type' => 'message_type',
    'timestamp_format' => 'timestamp_format',
    'compression_codec' => 'compression_codec',
    'period' => 'period',
    'gzip_level' => 'gzip_level',
    'access_key' => 'access_key',
    'bucket_name' => 'bucket_name',
    'path' => 'path',
    'region' => 'region',
    'public_key' => 'public_key',
    'user' => 'user',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
