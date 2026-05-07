<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Amazon Kinesis log endpoints
 *
 * Maps to Fastly generated client operation LoggingKinesisApi::listLogKinesis (GET /service/{service_id}/version/{version_id}/logging/kinesis).
 */
class FastlyLoggingKinesisListLogKinesis extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_kinesis_list_log_kinesis';
    protected const DESCRIPTION = 'List Amazon Kinesis log endpoints

Official Fastly client operation: LoggingKinesisApi::listLogKinesis
Endpoint: GET /service/{service_id}/version/{version_id}/logging/kinesis

List Amazon Kinesis log endpoints';
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
  'slug' => 'fastly_logging_kinesis_list_log_kinesis',
  'class' => 'FastlyLoggingKinesisListLogKinesis',
  'api_class' => 'LoggingKinesisApi',
  'method_name' => 'listLogKinesis',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/kinesis',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Amazon Kinesis log endpoints',
  'description' => 'List Amazon Kinesis log endpoints',
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
