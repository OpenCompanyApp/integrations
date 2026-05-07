<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a Loggly log endpoint
 *
 * Maps to Fastly generated client operation LoggingLogglyApi::deleteLogLoggly (DELETE /service/{service_id}/version/{version_id}/logging/loggly/{logging_loggly_name}).
 */
class FastlyLoggingLogglyDeleteLogLoggly extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_loggly_delete_log_loggly';
    protected const DESCRIPTION = 'Delete a Loggly log endpoint

Official Fastly client operation: LoggingLogglyApi::deleteLogLoggly
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/loggly/{logging_loggly_name}

Delete a Loggly log endpoint';
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
  'slug' => 'fastly_logging_loggly_delete_log_loggly',
  'class' => 'FastlyLoggingLogglyDeleteLogLoggly',
  'api_class' => 'LoggingLogglyApi',
  'method_name' => 'deleteLogLoggly',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/loggly/{logging_loggly_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a Loggly log endpoint',
  'description' => 'Delete a Loggly log endpoint',
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
