<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update the Amazon Kinesis log endpoint
 *
 * Maps to Fastly generated client operation LoggingKinesisApi::updateLogKinesis (PUT /service/{service_id}/version/{version_id}/logging/kinesis/{logging_kinesis_name}).
 */
class FastlyLoggingKinesisUpdateLogKinesis extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_kinesis_update_log_kinesis';
    protected const DESCRIPTION = 'Update the Amazon Kinesis log endpoint

Official Fastly client operation: LoggingKinesisApi::updateLogKinesis
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/kinesis/{logging_kinesis_name}

Update the Amazon Kinesis log endpoint';
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
  'logging_kinesis_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_kinesis_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_kinesis_update_log_kinesis',
  'class' => 'FastlyLoggingKinesisUpdateLogKinesis',
  'api_class' => 'LoggingKinesisApi',
  'method_name' => 'updateLogKinesis',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/kinesis/{logging_kinesis_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update the Amazon Kinesis log endpoint',
  'description' => 'Update the Amazon Kinesis log endpoint',
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
    'logging_kinesis_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_kinesis_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_kinesis_name' => 'logging_kinesis_name',
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
