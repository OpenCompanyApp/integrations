<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create an Amazon Kinesis log endpoint
 *
 * Maps to Fastly generated client operation LoggingKinesisApi::createLogKinesis (POST /service/{service_id}/version/{version_id}/logging/kinesis).
 */
class FastlyLoggingKinesisCreateLogKinesis extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_kinesis_create_log_kinesis';
    protected const DESCRIPTION = 'Create an Amazon Kinesis log endpoint

Official Fastly client operation: LoggingKinesisApi::createLogKinesis
Endpoint: POST /service/{service_id}/version/{version_id}/logging/kinesis

Create an Amazon Kinesis log endpoint';
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
  'format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format`.',
  ),
  'topic' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `topic`.',
  ),
  'region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `region`.',
  ),
  'secret_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `secret_key`.',
  ),
  'access_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `access_key`.',
  ),
  'iam_role' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `iam_role`.',
  ),
  'format_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format_version`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_kinesis_create_log_kinesis',
  'class' => 'FastlyLoggingKinesisCreateLogKinesis',
  'api_class' => 'LoggingKinesisApi',
  'method_name' => 'createLogKinesis',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/logging/kinesis',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create an Amazon Kinesis log endpoint',
  'description' => 'Create an Amazon Kinesis log endpoint',
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
    'format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format`.',
    ),
    'topic' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `topic`.',
    ),
    'region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `region`.',
    ),
    'secret_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `secret_key`.',
    ),
    'access_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `access_key`.',
    ),
    'iam_role' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `iam_role`.',
    ),
    'format_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format_version`.',
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
    'format' => 'format',
    'topic' => 'topic',
    'region' => 'region',
    'secret_key' => 'secret_key',
    'access_key' => 'access_key',
    'iam_role' => 'iam_role',
    'format_version' => 'format_version',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
