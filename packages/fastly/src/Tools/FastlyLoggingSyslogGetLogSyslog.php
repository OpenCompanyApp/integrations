<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a syslog log endpoint
 *
 * Maps to Fastly generated client operation LoggingSyslogApi::getLogSyslog (GET /service/{service_id}/version/{version_id}/logging/syslog/{logging_syslog_name}).
 */
class FastlyLoggingSyslogGetLogSyslog extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_syslog_get_log_syslog';
    protected const DESCRIPTION = 'Get a syslog log endpoint

Official Fastly client operation: LoggingSyslogApi::getLogSyslog
Endpoint: GET /service/{service_id}/version/{version_id}/logging/syslog/{logging_syslog_name}

Get a syslog log endpoint';
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
  'logging_syslog_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_syslog_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_syslog_get_log_syslog',
  'class' => 'FastlyLoggingSyslogGetLogSyslog',
  'api_class' => 'LoggingSyslogApi',
  'method_name' => 'getLogSyslog',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/syslog/{logging_syslog_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a syslog log endpoint',
  'description' => 'Get a syslog log endpoint',
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
    'logging_syslog_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_syslog_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_syslog_name' => 'logging_syslog_name',
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
