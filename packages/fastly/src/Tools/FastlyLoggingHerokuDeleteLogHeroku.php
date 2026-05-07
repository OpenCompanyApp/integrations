<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete the Heroku log endpoint
 *
 * Maps to Fastly generated client operation LoggingHerokuApi::deleteLogHeroku (DELETE /service/{service_id}/version/{version_id}/logging/heroku/{logging_heroku_name}).
 */
class FastlyLoggingHerokuDeleteLogHeroku extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_heroku_delete_log_heroku';
    protected const DESCRIPTION = 'Delete the Heroku log endpoint

Official Fastly client operation: LoggingHerokuApi::deleteLogHeroku
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/heroku/{logging_heroku_name}

Delete the Heroku log endpoint';
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
  'slug' => 'fastly_logging_heroku_delete_log_heroku',
  'class' => 'FastlyLoggingHerokuDeleteLogHeroku',
  'api_class' => 'LoggingHerokuApi',
  'method_name' => 'deleteLogHeroku',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/heroku/{logging_heroku_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete the Heroku log endpoint',
  'description' => 'Delete the Heroku log endpoint',
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
