<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update the Heroku log endpoint
 *
 * Maps to Fastly generated client operation LoggingHerokuApi::updateLogHeroku (PUT /service/{service_id}/version/{version_id}/logging/heroku/{logging_heroku_name}).
 */
class FastlyLoggingHerokuUpdateLogHeroku extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_heroku_update_log_heroku';
    protected const DESCRIPTION = 'Update the Heroku log endpoint

Official Fastly client operation: LoggingHerokuApi::updateLogHeroku
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/heroku/{logging_heroku_name}

Update the Heroku log endpoint';
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
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `url`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_heroku_update_log_heroku',
  'class' => 'FastlyLoggingHerokuUpdateLogHeroku',
  'api_class' => 'LoggingHerokuApi',
  'method_name' => 'updateLogHeroku',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/heroku/{logging_heroku_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update the Heroku log endpoint',
  'description' => 'Update the Heroku log endpoint',
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
    'name' => 'name',
    'placement' => 'placement',
    'response_condition' => 'response_condition',
    'format' => 'format',
    'log_processing_region' => 'log_processing_region',
    'format_version' => 'format_version',
    'token' => 'token',
    'url' => 'url',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
