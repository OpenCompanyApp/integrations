<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Kafka log endpoint
 *
 * Maps to Fastly generated client operation LoggingKafkaApi::getLogKafka (GET /service/{service_id}/version/{version_id}/logging/kafka/{logging_kafka_name}).
 */
class FastlyLoggingKafkaGetLogKafka extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_kafka_get_log_kafka';
    protected const DESCRIPTION = 'Get a Kafka log endpoint

Official Fastly client operation: LoggingKafkaApi::getLogKafka
Endpoint: GET /service/{service_id}/version/{version_id}/logging/kafka/{logging_kafka_name}

Get a Kafka log endpoint';
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
  'slug' => 'fastly_logging_kafka_get_log_kafka',
  'class' => 'FastlyLoggingKafkaGetLogKafka',
  'api_class' => 'LoggingKafkaApi',
  'method_name' => 'getLogKafka',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/kafka/{logging_kafka_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Kafka log endpoint',
  'description' => 'Get a Kafka log endpoint',
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
