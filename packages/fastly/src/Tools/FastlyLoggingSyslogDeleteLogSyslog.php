<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a syslog log endpoint
 *
 * Maps to Fastly generated client operation LoggingSyslogApi::deleteLogSyslog (DELETE /service/{service_id}/version/{version_id}/logging/syslog/{logging_syslog_name}).
 */
class FastlyLoggingSyslogDeleteLogSyslog extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_syslog_delete_log_syslog';
    protected const DESCRIPTION = 'Delete a syslog log endpoint

Official Fastly client operation: LoggingSyslogApi::deleteLogSyslog
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/syslog/{logging_syslog_name}

Delete a syslog log endpoint';
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
  'slug' => 'fastly_logging_syslog_delete_log_syslog',
  'class' => 'FastlyLoggingSyslogDeleteLogSyslog',
  'api_class' => 'LoggingSyslogApi',
  'method_name' => 'deleteLogSyslog',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/syslog/{logging_syslog_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a syslog log endpoint',
  'description' => 'Delete a syslog log endpoint',
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
