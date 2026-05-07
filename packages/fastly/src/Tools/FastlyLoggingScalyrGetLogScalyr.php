<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Scalyr log endpoint
 *
 * Maps to Fastly generated client operation LoggingScalyrApi::getLogScalyr (GET /service/{service_id}/version/{version_id}/logging/scalyr/{logging_scalyr_name}).
 */
class FastlyLoggingScalyrGetLogScalyr extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_scalyr_get_log_scalyr';
    protected const DESCRIPTION = 'Get a Scalyr log endpoint

Official Fastly client operation: LoggingScalyrApi::getLogScalyr
Endpoint: GET /service/{service_id}/version/{version_id}/logging/scalyr/{logging_scalyr_name}

Get a Scalyr log endpoint';
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
  'logging_scalyr_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_scalyr_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_scalyr_get_log_scalyr',
  'class' => 'FastlyLoggingScalyrGetLogScalyr',
  'api_class' => 'LoggingScalyrApi',
  'method_name' => 'getLogScalyr',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/scalyr/{logging_scalyr_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Scalyr log endpoint',
  'description' => 'Get a Scalyr log endpoint',
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
    'logging_scalyr_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_scalyr_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_scalyr_name' => 'logging_scalyr_name',
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
