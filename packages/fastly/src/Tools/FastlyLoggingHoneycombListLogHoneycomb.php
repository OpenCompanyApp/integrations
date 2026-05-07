<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Honeycomb log endpoints
 *
 * Maps to Fastly generated client operation LoggingHoneycombApi::listLogHoneycomb (GET /service/{service_id}/version/{version_id}/logging/honeycomb).
 */
class FastlyLoggingHoneycombListLogHoneycomb extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_honeycomb_list_log_honeycomb';
    protected const DESCRIPTION = 'List Honeycomb log endpoints

Official Fastly client operation: LoggingHoneycombApi::listLogHoneycomb
Endpoint: GET /service/{service_id}/version/{version_id}/logging/honeycomb

List Honeycomb log endpoints';
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
  'slug' => 'fastly_logging_honeycomb_list_log_honeycomb',
  'class' => 'FastlyLoggingHoneycombListLogHoneycomb',
  'api_class' => 'LoggingHoneycombApi',
  'method_name' => 'listLogHoneycomb',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/honeycomb',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Honeycomb log endpoints',
  'description' => 'List Honeycomb log endpoints',
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
