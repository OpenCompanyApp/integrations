<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Loggly log endpoints
 *
 * Maps to Fastly generated client operation LoggingLogglyApi::listLogLoggly (GET /service/{service_id}/version/{version_id}/logging/loggly).
 */
class FastlyLoggingLogglyListLogLoggly extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_loggly_list_log_loggly';
    protected const DESCRIPTION = 'List Loggly log endpoints

Official Fastly client operation: LoggingLogglyApi::listLogLoggly
Endpoint: GET /service/{service_id}/version/{version_id}/logging/loggly

List Loggly log endpoints';
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
  'slug' => 'fastly_logging_loggly_list_log_loggly',
  'class' => 'FastlyLoggingLogglyListLogLoggly',
  'api_class' => 'LoggingLogglyApi',
  'method_name' => 'listLogLoggly',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/loggly',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Loggly log endpoints',
  'description' => 'List Loggly log endpoints',
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
