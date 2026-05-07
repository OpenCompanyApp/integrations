<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a Honeycomb log endpoint
 *
 * Maps to Fastly generated client operation LoggingHoneycombApi::updateLogHoneycomb (PUT /service/{service_id}/version/{version_id}/logging/honeycomb/{logging_honeycomb_name}).
 */
class FastlyLoggingHoneycombUpdateLogHoneycomb extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_honeycomb_update_log_honeycomb';
    protected const DESCRIPTION = 'Update a Honeycomb log endpoint

Official Fastly client operation: LoggingHoneycombApi::updateLogHoneycomb
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/honeycomb/{logging_honeycomb_name}

Update a Honeycomb log endpoint';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'placement' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `placement`.',
  ),
  'response_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `response_condition`.',
  ),
  'format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format`.',
  ),
  'log_processing_region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `log_processing_region`.',
  ),
  'format_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format_version`.',
  ),
  'dataset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `dataset`.',
  ),
  'token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `token`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_honeycomb_update_log_honeycomb',
  'class' => 'FastlyLoggingHoneycombUpdateLogHoneycomb',
  'api_class' => 'LoggingHoneycombApi',
  'method_name' => 'updateLogHoneycomb',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/honeycomb/{logging_honeycomb_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a Honeycomb log endpoint',
  'description' => 'Update a Honeycomb log endpoint',
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
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'placement' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `placement`.',
    ),
    'response_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `response_condition`.',
    ),
    'format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format`.',
    ),
    'log_processing_region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `log_processing_region`.',
    ),
    'format_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format_version`.',
    ),
    'dataset' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `dataset`.',
    ),
    'token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `token`.',
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
    'name' => 'name',
    'placement' => 'placement',
    'response_condition' => 'response_condition',
    'format' => 'format',
    'log_processing_region' => 'log_processing_region',
    'format_version' => 'format_version',
    'dataset' => 'dataset',
    'token' => 'token',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
