<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Loggly log endpoint
 *
 * Maps to Fastly generated client operation LoggingLogglyApi::getLogLoggly (GET /service/{service_id}/version/{version_id}/logging/loggly/{logging_loggly_name}).
 */
class FastlyLoggingLogglyGetLogLoggly extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_loggly_get_log_loggly';
    protected const DESCRIPTION = 'Get a Loggly log endpoint

Official Fastly client operation: LoggingLogglyApi::getLogLoggly
Endpoint: GET /service/{service_id}/version/{version_id}/logging/loggly/{logging_loggly_name}

Get a Loggly log endpoint';
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
  'logging_loggly_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_loggly_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_loggly_get_log_loggly',
  'class' => 'FastlyLoggingLogglyGetLogLoggly',
  'api_class' => 'LoggingLogglyApi',
  'method_name' => 'getLogLoggly',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/loggly/{logging_loggly_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Loggly log endpoint',
  'description' => 'Get a Loggly log endpoint',
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
    'logging_loggly_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_loggly_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_loggly_name' => 'logging_loggly_name',
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
