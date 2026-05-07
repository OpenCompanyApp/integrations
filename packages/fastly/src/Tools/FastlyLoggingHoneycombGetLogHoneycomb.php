<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Honeycomb log endpoint
 *
 * Maps to Fastly generated client operation LoggingHoneycombApi::getLogHoneycomb (GET /service/{service_id}/version/{version_id}/logging/honeycomb/{logging_honeycomb_name}).
 */
class FastlyLoggingHoneycombGetLogHoneycomb extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_honeycomb_get_log_honeycomb';
    protected const DESCRIPTION = 'Get a Honeycomb log endpoint

Official Fastly client operation: LoggingHoneycombApi::getLogHoneycomb
Endpoint: GET /service/{service_id}/version/{version_id}/logging/honeycomb/{logging_honeycomb_name}

Get a Honeycomb log endpoint';
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
  'logging_honeycomb_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_honeycomb_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_honeycomb_get_log_honeycomb',
  'class' => 'FastlyLoggingHoneycombGetLogHoneycomb',
  'api_class' => 'LoggingHoneycombApi',
  'method_name' => 'getLogHoneycomb',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/honeycomb/{logging_honeycomb_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Honeycomb log endpoint',
  'description' => 'Get a Honeycomb log endpoint',
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
    'logging_honeycomb_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_honeycomb_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_honeycomb_name' => 'logging_honeycomb_name',
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
