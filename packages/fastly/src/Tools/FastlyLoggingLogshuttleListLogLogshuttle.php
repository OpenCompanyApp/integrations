<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Log Shuttle log endpoints
 *
 * Maps to Fastly generated client operation LoggingLogshuttleApi::listLogLogshuttle (GET /service/{service_id}/version/{version_id}/logging/logshuttle).
 */
class FastlyLoggingLogshuttleListLogLogshuttle extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_logshuttle_list_log_logshuttle';
    protected const DESCRIPTION = 'List Log Shuttle log endpoints

Official Fastly client operation: LoggingLogshuttleApi::listLogLogshuttle
Endpoint: GET /service/{service_id}/version/{version_id}/logging/logshuttle

List Log Shuttle log endpoints';
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
  'slug' => 'fastly_logging_logshuttle_list_log_logshuttle',
  'class' => 'FastlyLoggingLogshuttleListLogLogshuttle',
  'api_class' => 'LoggingLogshuttleApi',
  'method_name' => 'listLogLogshuttle',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/logshuttle',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Log Shuttle log endpoints',
  'description' => 'List Log Shuttle log endpoints',
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
