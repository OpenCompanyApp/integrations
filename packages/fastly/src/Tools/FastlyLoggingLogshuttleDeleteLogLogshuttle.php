<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a Log Shuttle log endpoint
 *
 * Maps to Fastly generated client operation LoggingLogshuttleApi::deleteLogLogshuttle (DELETE /service/{service_id}/version/{version_id}/logging/logshuttle/{logging_logshuttle_name}).
 */
class FastlyLoggingLogshuttleDeleteLogLogshuttle extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_logshuttle_delete_log_logshuttle';
    protected const DESCRIPTION = 'Delete a Log Shuttle log endpoint

Official Fastly client operation: LoggingLogshuttleApi::deleteLogLogshuttle
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/logshuttle/{logging_logshuttle_name}

Delete a Log Shuttle log endpoint';
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
  'slug' => 'fastly_logging_logshuttle_delete_log_logshuttle',
  'class' => 'FastlyLoggingLogshuttleDeleteLogLogshuttle',
  'api_class' => 'LoggingLogshuttleApi',
  'method_name' => 'deleteLogLogshuttle',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/logshuttle/{logging_logshuttle_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a Log Shuttle log endpoint',
  'description' => 'Delete a Log Shuttle log endpoint',
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
