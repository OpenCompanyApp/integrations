<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Kafka log endpoints
 *
 * Maps to Fastly generated client operation LoggingKafkaApi::listLogKafka (GET /service/{service_id}/version/{version_id}/logging/kafka).
 */
class FastlyLoggingKafkaListLogKafka extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_kafka_list_log_kafka';
    protected const DESCRIPTION = 'List Kafka log endpoints

Official Fastly client operation: LoggingKafkaApi::listLogKafka
Endpoint: GET /service/{service_id}/version/{version_id}/logging/kafka

List Kafka log endpoints';
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
  'slug' => 'fastly_logging_kafka_list_log_kafka',
  'class' => 'FastlyLoggingKafkaListLogKafka',
  'api_class' => 'LoggingKafkaApi',
  'method_name' => 'listLogKafka',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/kafka',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Kafka log endpoints',
  'description' => 'List Kafka log endpoints',
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
