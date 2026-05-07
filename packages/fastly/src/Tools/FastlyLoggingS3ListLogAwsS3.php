<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List AWS S3 log endpoints
 *
 * Maps to Fastly generated client operation LoggingS3Api::listLogAwsS3 (GET /service/{service_id}/version/{version_id}/logging/s3).
 */
class FastlyLoggingS3ListLogAwsS3 extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_s3_list_log_aws_s3';
    protected const DESCRIPTION = 'List AWS S3 log endpoints

Official Fastly client operation: LoggingS3Api::listLogAwsS3
Endpoint: GET /service/{service_id}/version/{version_id}/logging/s3

List AWS S3 log endpoints';
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
  'slug' => 'fastly_logging_s3_list_log_aws_s3',
  'class' => 'FastlyLoggingS3ListLogAwsS3',
  'api_class' => 'LoggingS3Api',
  'method_name' => 'listLogAwsS3',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/s3',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List AWS S3 log endpoints',
  'description' => 'List AWS S3 log endpoints',
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
