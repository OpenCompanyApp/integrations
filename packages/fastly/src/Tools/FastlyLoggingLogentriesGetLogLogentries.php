<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Logentries log endpoint
 *
 * Maps to Fastly generated client operation LoggingLogentriesApi::getLogLogentries (GET /service/{service_id}/version/{version_id}/logging/logentries/{logging_logentries_name}).
 */
class FastlyLoggingLogentriesGetLogLogentries extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_logentries_get_log_logentries';
    protected const DESCRIPTION = 'Get a Logentries log endpoint

Official Fastly client operation: LoggingLogentriesApi::getLogLogentries
Endpoint: GET /service/{service_id}/version/{version_id}/logging/logentries/{logging_logentries_name}

Get a Logentries log endpoint';
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
  'logging_logentries_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_logentries_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_logentries_get_log_logentries',
  'class' => 'FastlyLoggingLogentriesGetLogLogentries',
  'api_class' => 'LoggingLogentriesApi',
  'method_name' => 'getLogLogentries',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/logentries/{logging_logentries_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Logentries log endpoint',
  'description' => 'Get a Logentries log endpoint',
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
    'logging_logentries_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_logentries_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_logentries_name' => 'logging_logentries_name',
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
