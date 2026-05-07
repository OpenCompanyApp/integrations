<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a New Relic OTLP endpoint
 *
 * Maps to Fastly generated client operation LoggingNewrelicotlpApi::getLogNewrelicotlp (GET /service/{service_id}/version/{version_id}/logging/newrelicotlp/{logging_newrelicotlp_name}).
 */
class FastlyLoggingNewrelicotlpGetLogNewrelicotlp extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_newrelicotlp_get_log_newrelicotlp';
    protected const DESCRIPTION = 'Get a New Relic OTLP endpoint

Official Fastly client operation: LoggingNewrelicotlpApi::getLogNewrelicotlp
Endpoint: GET /service/{service_id}/version/{version_id}/logging/newrelicotlp/{logging_newrelicotlp_name}

Get a New Relic OTLP endpoint';
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
  'logging_newrelicotlp_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_newrelicotlp_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_newrelicotlp_get_log_newrelicotlp',
  'class' => 'FastlyLoggingNewrelicotlpGetLogNewrelicotlp',
  'api_class' => 'LoggingNewrelicotlpApi',
  'method_name' => 'getLogNewrelicotlp',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/newrelicotlp/{logging_newrelicotlp_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a New Relic OTLP endpoint',
  'description' => 'Get a New Relic OTLP endpoint',
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
    'logging_newrelicotlp_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_newrelicotlp_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_newrelicotlp_name' => 'logging_newrelicotlp_name',
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
