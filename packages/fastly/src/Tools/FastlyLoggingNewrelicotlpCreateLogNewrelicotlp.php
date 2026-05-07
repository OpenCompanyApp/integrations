<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a New Relic OTLP endpoint
 *
 * Maps to Fastly generated client operation LoggingNewrelicotlpApi::createLogNewrelicotlp (POST /service/{service_id}/version/{version_id}/logging/newrelicotlp).
 */
class FastlyLoggingNewrelicotlpCreateLogNewrelicotlp extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_newrelicotlp_create_log_newrelicotlp';
    protected const DESCRIPTION = 'Create a New Relic OTLP endpoint

Official Fastly client operation: LoggingNewrelicotlpApi::createLogNewrelicotlp
Endpoint: POST /service/{service_id}/version/{version_id}/logging/newrelicotlp

Create a New Relic OTLP endpoint';
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
  'token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `token`.',
  ),
  'region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `region`.',
  ),
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `url`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_newrelicotlp_create_log_newrelicotlp',
  'class' => 'FastlyLoggingNewrelicotlpCreateLogNewrelicotlp',
  'api_class' => 'LoggingNewrelicotlpApi',
  'method_name' => 'createLogNewrelicotlp',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/logging/newrelicotlp',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a New Relic OTLP endpoint',
  'description' => 'Create a New Relic OTLP endpoint',
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
    'token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `token`.',
    ),
    'region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `region`.',
    ),
    'url' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `url`.',
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
    'name' => 'name',
    'placement' => 'placement',
    'response_condition' => 'response_condition',
    'format' => 'format',
    'log_processing_region' => 'log_processing_region',
    'format_version' => 'format_version',
    'token' => 'token',
    'region' => 'region',
    'url' => 'url',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
