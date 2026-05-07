<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a New Relic log endpoint
 *
 * Maps to Fastly generated client operation LoggingNewrelicApi::getLogNewrelic (GET /service/{service_id}/version/{version_id}/logging/newrelic/{logging_newrelic_name}).
 */
class FastlyLoggingNewrelicGetLogNewrelic extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_newrelic_get_log_newrelic';
    protected const DESCRIPTION = 'Get a New Relic log endpoint

Official Fastly client operation: LoggingNewrelicApi::getLogNewrelic
Endpoint: GET /service/{service_id}/version/{version_id}/logging/newrelic/{logging_newrelic_name}

Get a New Relic log endpoint';
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
  'logging_newrelic_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_newrelic_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_newrelic_get_log_newrelic',
  'class' => 'FastlyLoggingNewrelicGetLogNewrelic',
  'api_class' => 'LoggingNewrelicApi',
  'method_name' => 'getLogNewrelic',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/newrelic/{logging_newrelic_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a New Relic log endpoint',
  'description' => 'Get a New Relic log endpoint',
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
    'logging_newrelic_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_newrelic_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_newrelic_name' => 'logging_newrelic_name',
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
