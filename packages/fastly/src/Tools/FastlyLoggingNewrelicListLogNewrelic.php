<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List New Relic log endpoints
 *
 * Maps to Fastly generated client operation LoggingNewrelicApi::listLogNewrelic (GET /service/{service_id}/version/{version_id}/logging/newrelic).
 */
class FastlyLoggingNewrelicListLogNewrelic extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_newrelic_list_log_newrelic';
    protected const DESCRIPTION = 'List New Relic log endpoints

Official Fastly client operation: LoggingNewrelicApi::listLogNewrelic
Endpoint: GET /service/{service_id}/version/{version_id}/logging/newrelic

List New Relic log endpoints';
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
  'slug' => 'fastly_logging_newrelic_list_log_newrelic',
  'class' => 'FastlyLoggingNewrelicListLogNewrelic',
  'api_class' => 'LoggingNewrelicApi',
  'method_name' => 'listLogNewrelic',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/newrelic',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List New Relic log endpoints',
  'description' => 'List New Relic log endpoints',
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
