<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a syslog log endpoint
 *
 * Maps to Fastly generated client operation LoggingSyslogApi::createLogSyslog (POST /service/{service_id}/version/{version_id}/logging/syslog).
 */
class FastlyLoggingSyslogCreateLogSyslog extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_syslog_create_log_syslog';
    protected const DESCRIPTION = 'Create a syslog log endpoint

Official Fastly client operation: LoggingSyslogApi::createLogSyslog
Endpoint: POST /service/{service_id}/version/{version_id}/logging/syslog

Create a syslog log endpoint';
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
  'address' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `address`.',
  ),
  'port' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `port`.',
  ),
  'message_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `message_type`.',
  ),
  'hostname' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `hostname`.',
  ),
  'ipv4' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ipv4`.',
  ),
  'token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `token`.',
  ),
  'use_tls' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `use_tls`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_syslog_create_log_syslog',
  'class' => 'FastlyLoggingSyslogCreateLogSyslog',
  'api_class' => 'LoggingSyslogApi',
  'method_name' => 'createLogSyslog',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/logging/syslog',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a syslog log endpoint',
  'description' => 'Create a syslog log endpoint',
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
    'address' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `address`.',
    ),
    'port' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `port`.',
    ),
    'message_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `message_type`.',
    ),
    'hostname' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `hostname`.',
    ),
    'ipv4' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ipv4`.',
    ),
    'token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `token`.',
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
    'address' => 'address',
    'port' => 'port',
    'message_type' => 'message_type',
    'hostname' => 'hostname',
    'ipv4' => 'ipv4',
    'token' => 'token',
    'use_tls' => 'use_tls',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
