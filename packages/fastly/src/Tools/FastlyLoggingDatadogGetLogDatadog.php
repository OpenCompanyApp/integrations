<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Datadog log endpoint
 *
 * Maps to Fastly generated client operation LoggingDatadogApi::getLogDatadog (GET /service/{service_id}/version/{version_id}/logging/datadog/{logging_datadog_name}).
 */
class FastlyLoggingDatadogGetLogDatadog extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_datadog_get_log_datadog';
    protected const DESCRIPTION = 'Get a Datadog log endpoint

Official Fastly client operation: LoggingDatadogApi::getLogDatadog
Endpoint: GET /service/{service_id}/version/{version_id}/logging/datadog/{logging_datadog_name}

Get a Datadog log endpoint';
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
  'logging_datadog_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_datadog_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_datadog_get_log_datadog',
  'class' => 'FastlyLoggingDatadogGetLogDatadog',
  'api_class' => 'LoggingDatadogApi',
  'method_name' => 'getLogDatadog',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/datadog/{logging_datadog_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Datadog log endpoint',
  'description' => 'Get a Datadog log endpoint',
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
    'logging_datadog_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_datadog_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_datadog_name' => 'logging_datadog_name',
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
