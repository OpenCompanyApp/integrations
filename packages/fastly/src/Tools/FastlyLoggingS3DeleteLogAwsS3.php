<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an AWS S3 log endpoint
 *
 * Maps to Fastly generated client operation LoggingS3Api::deleteLogAwsS3 (DELETE /service/{service_id}/version/{version_id}/logging/s3/{logging_s3_name}).
 */
class FastlyLoggingS3DeleteLogAwsS3 extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_s3_delete_log_aws_s3';
    protected const DESCRIPTION = 'Delete an AWS S3 log endpoint

Official Fastly client operation: LoggingS3Api::deleteLogAwsS3
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/s3/{logging_s3_name}

Delete an AWS S3 log endpoint';
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
  'logging_s3_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_s3_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_s3_delete_log_aws_s3',
  'class' => 'FastlyLoggingS3DeleteLogAwsS3',
  'api_class' => 'LoggingS3Api',
  'method_name' => 'deleteLogAwsS3',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/s3/{logging_s3_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an AWS S3 log endpoint',
  'description' => 'Delete an AWS S3 log endpoint',
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
    'logging_s3_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_s3_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_s3_name' => 'logging_s3_name',
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
