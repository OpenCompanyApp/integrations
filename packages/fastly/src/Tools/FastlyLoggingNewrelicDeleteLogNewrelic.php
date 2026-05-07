<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a New Relic log endpoint
 *
 * Maps to Fastly generated client operation LoggingNewrelicApi::deleteLogNewrelic (DELETE /service/{service_id}/version/{version_id}/logging/newrelic/{logging_newrelic_name}).
 */
class FastlyLoggingNewrelicDeleteLogNewrelic extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_newrelic_delete_log_newrelic';
    protected const DESCRIPTION = 'Delete a New Relic log endpoint

Official Fastly client operation: LoggingNewrelicApi::deleteLogNewrelic
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/newrelic/{logging_newrelic_name}

Delete a New Relic log endpoint';
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
  'slug' => 'fastly_logging_newrelic_delete_log_newrelic',
  'class' => 'FastlyLoggingNewrelicDeleteLogNewrelic',
  'api_class' => 'LoggingNewrelicApi',
  'method_name' => 'deleteLogNewrelic',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/newrelic/{logging_newrelic_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a New Relic log endpoint',
  'description' => 'Delete a New Relic log endpoint',
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
