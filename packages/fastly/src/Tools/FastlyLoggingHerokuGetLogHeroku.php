<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Heroku log endpoint
 *
 * Maps to Fastly generated client operation LoggingHerokuApi::getLogHeroku (GET /service/{service_id}/version/{version_id}/logging/heroku/{logging_heroku_name}).
 */
class FastlyLoggingHerokuGetLogHeroku extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_heroku_get_log_heroku';
    protected const DESCRIPTION = 'Get a Heroku log endpoint

Official Fastly client operation: LoggingHerokuApi::getLogHeroku
Endpoint: GET /service/{service_id}/version/{version_id}/logging/heroku/{logging_heroku_name}

Get a Heroku log endpoint';
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
  'logging_heroku_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_heroku_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_heroku_get_log_heroku',
  'class' => 'FastlyLoggingHerokuGetLogHeroku',
  'api_class' => 'LoggingHerokuApi',
  'method_name' => 'getLogHeroku',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/heroku/{logging_heroku_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Heroku log endpoint',
  'description' => 'Get a Heroku log endpoint',
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
    'logging_heroku_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_heroku_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_heroku_name' => 'logging_heroku_name',
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
