<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create an AWS S3 log endpoint
 *
 * Maps to Fastly generated client operation LoggingS3Api::createLogAwsS3 (POST /service/{service_id}/version/{version_id}/logging/s3).
 */
class FastlyLoggingS3CreateLogAwsS3 extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_s3_create_log_aws_s3';
    protected const DESCRIPTION = 'Create an AWS S3 log endpoint

Official Fastly client operation: LoggingS3Api::createLogAwsS3
Endpoint: POST /service/{service_id}/version/{version_id}/logging/s3

Create an AWS S3 log endpoint';
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
  'acl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `acl`.',
  ),
  'bucket_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `bucket_name`.',
  ),
  'domain' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `domain`.',
  ),
  'iam_role' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `iam_role`.',
  ),
  'path' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `path`.',
  ),
  'public_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `public_key`.',
  ),
  'redundancy' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `redundancy`.',
  ),
  'secret_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `secret_key`.',
  ),
  'server_side_encryption_kms_key_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `server_side_encryption_kms_key_id`.',
  ),
  'server_side_encryption' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `server_side_encryption`.',
  ),
  'file_max_bytes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `file_max_bytes`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_s3_create_log_aws_s3',
  'class' => 'FastlyLoggingS3CreateLogAwsS3',
  'api_class' => 'LoggingS3Api',
  'method_name' => 'createLogAwsS3',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/logging/s3',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create an AWS S3 log endpoint',
  'description' => 'Create an AWS S3 log endpoint',
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
    'acl' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `acl`.',
    ),
    'bucket_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `bucket_name`.',
    ),
    'domain' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `domain`.',
    ),
    'iam_role' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `iam_role`.',
    ),
    'path' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `path`.',
    ),
    'public_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `public_key`.',
    ),
    'redundancy' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `redundancy`.',
    ),
    'secret_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `secret_key`.',
    ),
    'server_side_encryption_kms_key_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `server_side_encryption_kms_key_id`.',
    ),
    'server_side_encryption' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `server_side_encryption`.',
    ),
    'file_max_bytes' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `file_max_bytes`.',
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
    'acl' => 'acl',
    'bucket_name' => 'bucket_name',
    'domain' => 'domain',
    'iam_role' => 'iam_role',
    'path' => 'path',
    'public_key' => 'public_key',
    'redundancy' => 'redundancy',
    'secret_key' => 'secret_key',
    'server_side_encryption_kms_key_id' => 'server_side_encryption_kms_key_id',
    'server_side_encryption' => 'server_side_encryption',
    'file_max_bytes' => 'file_max_bytes',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
