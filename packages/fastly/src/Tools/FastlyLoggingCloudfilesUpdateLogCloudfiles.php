<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update the Cloud Files log endpoint
 *
 * Maps to Fastly generated client operation LoggingCloudfilesApi::updateLogCloudfiles (PUT /service/{service_id}/version/{version_id}/logging/cloudfiles/{logging_cloudfiles_name}).
 */
class FastlyLoggingCloudfilesUpdateLogCloudfiles extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_cloudfiles_update_log_cloudfiles';
    protected const DESCRIPTION = 'Update the Cloud Files log endpoint

Official Fastly client operation: LoggingCloudfilesApi::updateLogCloudfiles
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/cloudfiles/{logging_cloudfiles_name}

Update the Cloud Files log endpoint';
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
  'logging_cloudfiles_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_cloudfiles_name`.',
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
  'slug' => 'fastly_logging_cloudfiles_update_log_cloudfiles',
  'class' => 'FastlyLoggingCloudfilesUpdateLogCloudfiles',
  'api_class' => 'LoggingCloudfilesApi',
  'method_name' => 'updateLogCloudfiles',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/cloudfiles/{logging_cloudfiles_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update the Cloud Files log endpoint',
  'description' => 'Update the Cloud Files log endpoint',
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
    'logging_cloudfiles_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_cloudfiles_name`.',
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
    'logging_cloudfiles_name' => 'logging_cloudfiles_name',
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
