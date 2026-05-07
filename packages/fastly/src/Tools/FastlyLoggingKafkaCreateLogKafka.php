<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a Kafka log endpoint
 *
 * Maps to Fastly generated client operation LoggingKafkaApi::createLogKafka (POST /service/{service_id}/version/{version_id}/logging/kafka).
 */
class FastlyLoggingKafkaCreateLogKafka extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_kafka_create_log_kafka';
    protected const DESCRIPTION = 'Create a Kafka log endpoint

Official Fastly client operation: LoggingKafkaApi::createLogKafka
Endpoint: POST /service/{service_id}/version/{version_id}/logging/kafka

Create a Kafka log endpoint';
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
  'tls_ca_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_ca_cert`.',
  ),
  'tls_client_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_client_cert`.',
  ),
  'tls_client_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_client_key`.',
  ),
  'tls_hostname' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_hostname`.',
  ),
  'topic' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `topic`.',
  ),
  'brokers' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `brokers`.',
  ),
  'compression_codec' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `compression_codec`.',
  ),
  'required_acks' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `required_acks`.',
  ),
  'request_max_bytes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `request_max_bytes`.',
  ),
  'parse_log_keyvals' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `parse_log_keyvals`.',
  ),
  'auth_method' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `auth_method`.',
  ),
  'user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `user`.',
  ),
  'password' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `password`.',
  ),
  'use_tls' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `use_tls`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_kafka_create_log_kafka',
  'class' => 'FastlyLoggingKafkaCreateLogKafka',
  'api_class' => 'LoggingKafkaApi',
  'method_name' => 'createLogKafka',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/logging/kafka',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a Kafka log endpoint',
  'description' => 'Create a Kafka log endpoint',
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
    'tls_ca_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_ca_cert`.',
    ),
    'tls_client_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_client_cert`.',
    ),
    'tls_client_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_client_key`.',
    ),
    'tls_hostname' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_hostname`.',
    ),
    'topic' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `topic`.',
    ),
    'brokers' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `brokers`.',
    ),
    'compression_codec' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `compression_codec`.',
    ),
    'required_acks' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `required_acks`.',
    ),
    'request_max_bytes' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `request_max_bytes`.',
    ),
    'parse_log_keyvals' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `parse_log_keyvals`.',
    ),
    'auth_method' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `auth_method`.',
    ),
    'user' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `user`.',
    ),
    'password' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `password`.',
    ),
    'use_tls' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `use_tls`.',
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
    'tls_ca_cert' => 'tls_ca_cert',
    'tls_client_cert' => 'tls_client_cert',
    'tls_client_key' => 'tls_client_key',
    'tls_hostname' => 'tls_hostname',
    'topic' => 'topic',
    'brokers' => 'brokers',
    'compression_codec' => 'compression_codec',
    'required_acks' => 'required_acks',
    'request_max_bytes' => 'request_max_bytes',
    'parse_log_keyvals' => 'parse_log_keyvals',
    'auth_method' => 'auth_method',
    'user' => 'user',
    'password' => 'password',
    'use_tls' => 'use_tls',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
