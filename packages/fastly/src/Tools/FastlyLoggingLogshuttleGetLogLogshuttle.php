<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Log Shuttle log endpoint
 *
 * Maps to Fastly generated client operation LoggingLogshuttleApi::getLogLogshuttle (GET /service/{service_id}/version/{version_id}/logging/logshuttle/{logging_logshuttle_name}).
 */
class FastlyLoggingLogshuttleGetLogLogshuttle extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_logshuttle_get_log_logshuttle';
    protected const DESCRIPTION = 'Get a Log Shuttle log endpoint

Official Fastly client operation: LoggingLogshuttleApi::getLogLogshuttle
Endpoint: GET /service/{service_id}/version/{version_id}/logging/logshuttle/{logging_logshuttle_name}

Get a Log Shuttle log endpoint';
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
  'logging_logshuttle_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_logshuttle_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_logshuttle_get_log_logshuttle',
  'class' => 'FastlyLoggingLogshuttleGetLogLogshuttle',
  'api_class' => 'LoggingLogshuttleApi',
  'method_name' => 'getLogLogshuttle',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/logshuttle/{logging_logshuttle_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Log Shuttle log endpoint',
  'description' => 'Get a Log Shuttle log endpoint',
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
    'logging_logshuttle_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_logshuttle_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_logshuttle_name' => 'logging_logshuttle_name',
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
