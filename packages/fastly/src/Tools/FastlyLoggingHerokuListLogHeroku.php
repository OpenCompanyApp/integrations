<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Heroku log endpoints
 *
 * Maps to Fastly generated client operation LoggingHerokuApi::listLogHeroku (GET /service/{service_id}/version/{version_id}/logging/heroku).
 */
class FastlyLoggingHerokuListLogHeroku extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_heroku_list_log_heroku';
    protected const DESCRIPTION = 'List Heroku log endpoints

Official Fastly client operation: LoggingHerokuApi::listLogHeroku
Endpoint: GET /service/{service_id}/version/{version_id}/logging/heroku

List Heroku log endpoints';
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
  'slug' => 'fastly_logging_heroku_list_log_heroku',
  'class' => 'FastlyLoggingHerokuListLogHeroku',
  'api_class' => 'LoggingHerokuApi',
  'method_name' => 'listLogHeroku',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/heroku',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Heroku log endpoints',
  'description' => 'List Heroku log endpoints',
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
