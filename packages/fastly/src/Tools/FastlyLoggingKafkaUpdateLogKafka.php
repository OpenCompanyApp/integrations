<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update the Kafka log endpoint
 *
 * Maps to Fastly generated client operation LoggingKafkaApi::updateLogKafka (PUT /service/{service_id}/version/{version_id}/logging/kafka/{logging_kafka_name}).
 */
class FastlyLoggingKafkaUpdateLogKafka extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_kafka_update_log_kafka';
    protected const DESCRIPTION = 'Update the Kafka log endpoint

Official Fastly client operation: LoggingKafkaApi::updateLogKafka
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/kafka/{logging_kafka_name}

Update the Kafka log endpoint';
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
  'logging_kafka_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_kafka_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_kafka_update_log_kafka',
  'class' => 'FastlyLoggingKafkaUpdateLogKafka',
  'api_class' => 'LoggingKafkaApi',
  'method_name' => 'updateLogKafka',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/kafka/{logging_kafka_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update the Kafka log endpoint',
  'description' => 'Update the Kafka log endpoint',
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
    'logging_kafka_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_kafka_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_kafka_name' => 'logging_kafka_name',
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
