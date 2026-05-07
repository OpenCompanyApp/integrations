<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete the Honeycomb log endpoint
 *
 * Maps to Fastly generated client operation LoggingHoneycombApi::deleteLogHoneycomb (DELETE /service/{service_id}/version/{version_id}/logging/honeycomb/{logging_honeycomb_name}).
 */
class FastlyLoggingHoneycombDeleteLogHoneycomb extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_honeycomb_delete_log_honeycomb';
    protected const DESCRIPTION = 'Delete the Honeycomb log endpoint

Official Fastly client operation: LoggingHoneycombApi::deleteLogHoneycomb
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/honeycomb/{logging_honeycomb_name}

Delete the Honeycomb log endpoint';
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
  'slug' => 'fastly_logging_honeycomb_delete_log_honeycomb',
  'class' => 'FastlyLoggingHoneycombDeleteLogHoneycomb',
  'api_class' => 'LoggingHoneycombApi',
  'method_name' => 'deleteLogHoneycomb',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/honeycomb/{logging_honeycomb_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete the Honeycomb log endpoint',
  'description' => 'Delete the Honeycomb log endpoint',
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
