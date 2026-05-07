<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Syslog log endpoints
 *
 * Maps to Fastly generated client operation LoggingSyslogApi::listLogSyslog (GET /service/{service_id}/version/{version_id}/logging/syslog).
 */
class FastlyLoggingSyslogListLogSyslog extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_syslog_list_log_syslog';
    protected const DESCRIPTION = 'List Syslog log endpoints

Official Fastly client operation: LoggingSyslogApi::listLogSyslog
Endpoint: GET /service/{service_id}/version/{version_id}/logging/syslog

List Syslog log endpoints';
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
  'slug' => 'fastly_logging_syslog_list_log_syslog',
  'class' => 'FastlyLoggingSyslogListLogSyslog',
  'api_class' => 'LoggingSyslogApi',
  'method_name' => 'listLogSyslog',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/syslog',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Syslog log endpoints',
  'description' => 'List Syslog log endpoints',
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
